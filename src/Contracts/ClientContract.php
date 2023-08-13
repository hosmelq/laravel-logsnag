<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Contracts;

use HosmelQ\LogSnag\Laravel\Resources\Insight;
use HosmelQ\LogSnag\Laravel\Resources\Log;

interface ClientContract
{
    /**
     * Publish an insight to LogSnag.
     *
     * This method allows you to send insights to LogSnag. Insights are widgets that
     * can be added to projects and display real-time information.
     *
     * @see https://docs.logsnag.com/endpoints/insight
     */
    public function insight(): Insight;

    /**
     * Publish an event to LogSnag.
     *
     * This method allows you to send events to LogSnag. These events can be
     * any significant occurrences you want to monitor in your application.
     *
     * @see https://docs.logsnag.com/endpoints/log
     */
    public function log(): Log;
}
