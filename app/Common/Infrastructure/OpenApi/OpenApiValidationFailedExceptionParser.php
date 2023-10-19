<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\OpenApi;

use League\OpenAPIValidation\PSR7\Exception\ValidationFailed;
use League\OpenAPIValidation\Schema\BreadCrumb;
use League\OpenAPIValidation\Schema\Exception\SchemaMismatch;

trait OpenApiValidationFailedExceptionParser
{
    public function getOpenAPIValidatorExceptionMessage(ValidationFailed $exception): string
    {
        if ($exception->getPrevious() === null) {
            return $exception->getMessage();
        }

        $breadCrumb = '';
        if ($exception->getPrevious() instanceof SchemaMismatch) {
            $breadCrumb = $this->getValidationFailedBreadCrumbChain($exception->getPrevious());
        }

        return trim("$breadCrumb {$this->getValidationFailedMessage($exception)}");
    }

    private function getValidationFailedBreadCrumbChain(SchemaMismatch $exception): string
    {
        $breadCrumb = $exception->dataBreadCrumb();
        if ($breadCrumb instanceof BreadCrumb) {
            return '[ ' . implode('.', $breadCrumb->buildChain()) . ' ]';
        }

        return '';
    }

    private function getValidationFailedMessage(ValidationFailed $exception): string
    {
        $message = $exception->getPrevious()?->getMessage();

        if (is_string($message)) {
            return $message;
        }

        return '';
    }
}
