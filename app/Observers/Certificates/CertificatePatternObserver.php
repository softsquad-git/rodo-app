<?php

namespace App\Observers\Certificates;

use App\Models\Certificates\CertificatePattern;

class CertificatePatternObserver
{
    /**
     * @param CertificatePattern $certificatePattern
     */
    public function deleted(CertificatePattern $certificatePattern)
    {
        $certificatePattern->tests()->detach();
    }
}
