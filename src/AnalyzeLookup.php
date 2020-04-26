<?php

namespace Yosmy\Phone;

/**
 * @di\service()
 */
class AnalyzeLookup
{
    /**
     * @var ResolveClassification
     */
    private $resolveClassification;

    /**
     * @param ResolveClassification $resolveClassification
     */
    public function __construct(ResolveClassification $resolveClassification)
    {
        $this->resolveClassification = $resolveClassification;
    }

    /**
     * @param string $country
     * @param string $prefix
     * @param string $number
     *
     * @throws VerificationException
     */
    public function analyze(
        string $country,
        string $prefix,
        string $number
    ) {
        try {
            $lookup = $this->resolveClassification->resolve(
                $country,
                $prefix,
                $number
            );
        } catch (UnresolvableClassificationException $e) {
            throw new VerificationException('El número de teléfono es incorrecto.');
        }

        if ($lookup->isVoip()) {
            throw new VerificationException('El número de teléfono es incorrecto.');
        }
    }
}