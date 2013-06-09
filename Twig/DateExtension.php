<?php

namespace Codepeak\TwigdateBundle\Twig;

use Symfony\Component\Translation\TranslatorInterface;

class DateExtension extends \Twig_Extension
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('nicedate', array($this, 'niceDate')),
        );
    }

    /**
     * @return TranslatorInterface
     */
    private function getTranslator()
    {
        return $this->translator;
    }

    /**
     * @param \DateTime $timestamp
     * @param bool      $lowercase
     *
     * @return int|string
     */
    public function niceDate(\DateTime $timestamp, $lowercase = false)
    {
        // Set current time
        $now = new \DateTime();

        // Calculate the seconds diffing from now
        $seconds = $now->getTimestamp() - $timestamp->getTimestamp();

        // If it's been less than a minute
        if ($seconds < 60) {
            return $this->fixCase($this->getTranslator()->trans(
                '%secs% ago',
                array(
                    '%secs%' => $seconds
                )
            ), $lowercase);
        }

        // Less than 45 minutes ago
        if ($seconds < 2700) {
            return $this->fixCase($this->getTranslator()->trans(
                '%mins% ago',
                array(
                    '%mins%' => ceil($seconds / 60)
                )
            ), $lowercase);
        }

        // Less than an hour
        if ($seconds < 3600) {
            return $this->fixCase($this->getTranslator()->trans(
                'almost an hour ago',
                array(
                    '%secs%' => $seconds
                )
            ), $lowercase);
        }

        // Less than 24 hours ago
        if ($seconds < 86400) {
            return $this->fixCase($this->getTranslator()->trans(
                '%hours% ago',
                array(
                    '%secs%' => $seconds
                )
            ), $lowercase);
        }

        // Less than a week
        if ($seconds < 604800) {
            return $this->fixCase($this->getTranslator()->trans(
                'last %weekday%',
                array(
                    '%weekday%' => date("l", $timestamp->getTimestamp())
                )
            ), $lowercase);
        }

        // Less than a month
        if ($seconds < 2419200) {
            return $this->fixCase($this->getTranslator()->trans(
                '%weeks% ago',
                array(
                    '%weeks%' => floor($seconds / 604800)
                )
            ), $lowercase);
        }

        // Less than a year
        if ($seconds < 31536000) {
            return $this->fixCase($this->getTranslator()->trans(
                '%months% ago',
                array(
                    '%months%' => floor($seconds / 2419200)
                )
            ), $lowercase);
        }

        return $seconds;


        // Check if time is less than 60 seconds ago
        return 'hej';

    }

    /**
     * @param string $string
     * @param bool   $lowercase
     *
     * @return string
     */
    public function fixCase($string, $lowercase = false)
    {
        if ($lowercase) {
            $string = mb_strtolower($string);
        }

        return $string;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'codepeakdate_extension';
    }
}