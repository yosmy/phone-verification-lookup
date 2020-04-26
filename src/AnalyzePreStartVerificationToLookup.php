<?php

namespace Yosmy\Phone;

/**
 * @di\service({
 *     tags: [
 *         'yosmy.phone.pre_start_verification',
 *     ]
 * })
 */
class AnalyzePreStartVerificationToLookup implements AnalyzePreStartVerification
{
    /**
     * @var AnalyzeLookup
     */
    private $analyzeLookup;

    /**
     * @param AnalyzeLookup $analyzeLookup
     */
    public function __construct(AnalyzeLookup $analyzeLookup)
    {
        $this->analyzeLookup = $analyzeLookup;
    }

    /**
     * {@inheritDoc}
     */
    public function analyze(
        string $country,
        string $prefix,
        string $number
    ) {
        try {
            $this->analyzeLookup->analyze(
                $country,
                $prefix,
                $number
            );
        } catch (VerificationException $e) {
            throw $e;
        }
    }
}