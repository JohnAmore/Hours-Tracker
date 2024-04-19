<?php
class Parser
{
    private $dateList;

    function __construct($dateList)
    {
        $this->dateList = $dateList;
    }

    function getID($i)
    {
        return $this->dateList[$i][0];
    }

    function getStartDate($i)
    {
        $startDate = explode(" ", $this->dateList[$i][1]);
        $startDate = $startDate[0];
        return $startDate;
    }
    function getStartTime($i)
    {
        $startDate = explode(" ", $this->dateList[$i][1]);
        $startTime = $startDate[1];
        return $startTime;
    }

    function getEndTime($i)
    {
        $endDate = explode(" ", $this->dateList[$i][2]);
        $endTime = $endDate[1];
        return $endTime;
    }
}
