<?php declare(strict_types=1);
/**
 * Created 2023-11-21 12:07:09
 * Author rkwadriga
 */

namespace App\EventListener;

use ApiPlatform\Serializer\SerializerContextBuilderInterface;
use ApiPlatform\Symfony\EventListener\DeserializeListener;
use ApiPlatform\Symfony\Util\RequestAttributesExtractor;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

#[AsDecorator('api_platform.listener.request.deserialize')]
class RequestDeserializeListener
{
    public function __construct(
        private readonly DeserializeListener $decorated,
        private readonly SerializerContextBuilderInterface $contextBuilder,
        private readonly DenormalizerInterface $denormalizer
    ) {}

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        if (in_array($request->getMethod(), [Request::METHOD_HEAD, Request::METHOD_OPTIONS, Request::METHOD_DELETE])) {
            return;
        }

        if ($request->getContentTypeFormat() === 'form' || $request->getMethod() === Request::METHOD_GET) {
            $this->denormalizeFormRequest($request);
        }

        $this->decorated->onKernelRequest($event);
    }

    private function denormalizeFormRequest(Request $request): void
    {
        $attributes = RequestAttributesExtractor::extractAttributes($request);
        if ($attributes === []) {
            return;
        }

        $context = $this->contextBuilder->createFromRequest($request, false, $attributes);
        $populated = $request->attributes->get('data');
        if ($populated !== null) {
            $context['object_to_populate'] = $populated;
        }

        if (!isset($context['not_normalizable_value_exceptions'])) {
            $context['not_normalizable_value_exceptions'] = [];
        }

        $data = $request->request->all() + $request->query->all() + $context['uri_variables'];
        $object = $this->denormalizer->denormalize($data, $attributes['resource_class'], null, $context);
        $request->attributes->set('data', $object);
    }
}