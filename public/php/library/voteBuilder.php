<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/library/AbstractBuilder.php');

class VoteBuilder extends AbstractBuilder {
    CONST UPVOTES = '{{upVotes}}';
    CONST DOWNVOTES = '{{downVotes}}';
    CONST ARROWUP = '<arrowUp />';
    CONST ARROWDOWN = '<arrowDown />';
    CONST ARTICLEID = '{{articleId}}';
    CONST ARROWUPCOLORED = '{{colour}}';
    CONST ARROWDOWNCOLORED = '{{colour}}';

    private $UpVotes;
    private $DownVotes;
    private $ArticleId;

    function __construct() {
        $this->Params[VoteBuilder::UPVOTES] = '0';
        $this->Params[VoteBuilder::DOWNVOTES] = '0';
        $this->Params[VoteBuilder::ARROWDOWN] = "";
        $this->Params[VoteBuilder::ARROWUP] = "";
    }

    public function getUpVotes() {
        return $this->UpVotes;
    }
    public function setUpVotes($vote) {
        if($vote != "")
            $this->UpVotes = $vote;
        else 
            $this->UpVotes = '0';
        $this->Params[VoteBuilder::UPVOTES] = $this->getUpVotes();
        return $this;
    }
    public function getDownVotes() {
        return $this->DownVotes;
    }
    public function setDownVote($vote) {
        if($vote != "")
            $this->DownVotes = $vote;
        else 
            $this->DownVotes = '0';
        $this->Params[VoteBuilder::DOWNVOTES] = $this->getDownVotes();
        return $this;
    }
    public function setArticleId($Id) {
        $this->ArticleId = $Id;
        $this->Params[VoteBuilder::ARTICLEID] = $Id;
        return $this;
    }
    public function setAutenticationOptions() {
            $this->Params[VoteBuilder::ARROWUP] = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/arrowUp.phtml');
            $this->Params[VoteBuilder::ARROWDOWN] = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/arrowDown.phtml');
    }
    public function setUpVotesColored($bool) {
        if($bool)
            $this->Params[VoteBuilder::ARROWUPCOLORED] = '{{fa-arrow-up-colored}}';
        else 
            $this->Params[VoteBuilder::ARROWUPCOLORED] = "";
    }
    public function setDownVotesColored($bool) {
        if($bool)
            $this->Params[VoteBuilder::ARROWDOWNCOLORED] = '{{fa-arrow-down-colored}}';
        else 
            $this->Params[VoteBuilder::ARROWDOWNCOLORED] = "";
    }
}
?>