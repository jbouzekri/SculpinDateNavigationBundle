<?php

namespace Jb\Bundle\DateNavigationBundle;

use Sculpin\Core\DataProvider\DataProviderInterface;

/**
 * DateNavigationProvider
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
class DateNavigationProvider implements DataProviderInterface
{
    /**
     * @var \Sculpin\Core\DataProvider\DataProviderInterface
     */
    private $dataProvider;

    /**
     * @var mixed
     */
    private $computedData = false;

    /**
     * Constructor
     *
     * @param \Sculpin\Core\DataProvider\DataProviderInterface $dataProviderManager
     */
    public function __construct(DataProviderInterface $dataProviderManager)
    {
        $this->dataProvider = $dataProviderManager;
    }

    /**
     * Provide data about post organized per year and couple year/month
     *
     * Return array(
     *   'year' = > array of posts,
     *   'year-month' => array of posts
     * )
     *
     * @return array
     */
    public function provideData()
    {
        if ($this->computedData !== false) {
            return $this->computedData;
        }

        $data = array();

        foreach ($this->dataProvider->provideData() as $post) {
            $date = \DateTime::createFromFormat('U', 0);
            if ($post->date() !== "") {
                $date = \DateTime::createFromFormat('U', $post->date());
            }

            $year = $date->format('Y');
            $month = $date->format('m');
            $keyDate = \DateTime::createFromFormat('Y-m',$year.'-'.$month);

            if (!isset($data[$year])) {
                $data[$year] = array(
                    'posts' => array(),
                    'months' => array(),
                    'date' => $keyDate
                );
            }

            if (!isset($data[$year]['months'])) {
                $data[$year]['months'] = array('posts' => array(), 'date' => $keyDate);
            }

            $data[$year]['posts'][] = $post;
            $data[$year]['months'][$month]['posts'][] = $post;
        }

        $this->computedData = $data;

        return $data;
    }
}
