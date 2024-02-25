<?php

namespace FnsService\Entity;

use DateTime;
use FnsService\Contracts\FnsEntity as ContractsFnsEntity;
use FnsService\Contracts\FullName as ContractFullName;

/**
 * Class FnsEntity
 */
class FnsEntity implements ContractsFnsEntity
{
    /**
     * @var FullName The full name of the entity.
     */
    private ContractFullName $fullName;

    /**
     * @var DateTime The birth date of the entity.
     */
    private DateTime $birthDay;

    /**
     * @var int The document type of the entity.
     */
    private $docType = 10;

    /**
     * @var string|int The identification document of the entity.
     */
    private $identifyDocument;

    /**
     * @var array The query string parameters for the FNS service.
     */
    private $queryString;

    /**
     * FnsEntity constructor.
     *
     * @param FullName $fullName The full name of the entity.
     * @param DateTime $birthDay The birth date of the entity.
     * @param FnsDocumentType $docType The document type of the entity.
     * @param mixed $identifyDocument The identification document of the entity.
     */
    public function __construct(ContractFullName $fullName, DateTime $birthDay,  $identifyDocument)
    {
        $this->fullName = $fullName;
        $this->birthDay = $birthDay;
        $this->identifyDocument = $identifyDocument;
        $this->prepare();
    }

    /**
     * Prepare the query string parameters for the FNS service.
     *
     * @return self
     */
    protected function prepare(): self
    {
        $this->queryString = [
            'fam' => $this->fullName->lastName,
            'nam' => $this->fullName->firstName,
            'otch' => $this->fullName->patronymic,
            'docno' => $this->identifyDocument,
            'c' => 'find',
            'captcha' => '',
            'captchaToken' => '',
            'bdate' => $this->birthDay->format('d.m.Y'),
            'doctype' => $this->docType
        ];

        if (!$this->fullName->patronymic) {
            $this->queryString['opt_otch'] = '1';
        }

        return $this;
    }

    /**
     * URL-encode the query string parameters.
     *
     * @return string The URL-encoded query string.
     */
    public function urlEncode(): string
    {
        return http_build_query($this->queryString);
    }

    /**
     * Get the query string parameters as an array.
     *
     * @return array The query string parameters as an array.
     */
    public function toArray(): array
    {
        return $this->queryString;
    }
}
