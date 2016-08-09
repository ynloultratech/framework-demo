<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class Continent
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var ArrayCollection|Country[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Country", mappedBy="continent", cascade={"all"})
     */
    protected $countries;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArrayCollection|Country[]
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * @param ArrayCollection|Country[] $countries
     *
     * @return $this
     */
    public function setCountries($countries)
    {
        $this->countries = $countries;

        return $this;
    }

    /**
     * addCountry
     *
     * @param Country $country
     *
     * @return $this
     */
    public function addCountry(Country $country)
    {
        $country->setContinent($this);
        $this->countries->add($country);

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
