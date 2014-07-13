<?php

namespace Jb\Bundle\DateNavigationBundle\Permalink;

/**
 * PermalinkFactory
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
class PermalinkFactory
{
    /**
     * @var string
     */
    protected $maskYear;

    /**
     * @var string
     */
    protected $maskMonth;

    /**
     * Constructor
     *
     * @param string $mask
     */
    public function __construct($maskYear, $maskMonth)
    {
        $this->maskYear = $maskYear;
        $this->maskMonth = $maskMonth;
    }

    /**
     * Get year url
     *
     * @param string $year
     */
    public function getYear($year)
    {
        return str_replace(':year', $year, $this->maskYear);
    }

    /**
     * Get year url
     *
     * @param string $year
     * @param string $month
     */
    public function getMonth($year, $month)
    {
        return str_replace(
            array(':year', ':month'),
            array($year, $month),
            $this->maskMonth
        );
    }
}
