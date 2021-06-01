<?php

require_once(__DIR__ . '/AbstractBuilder.php');

class VoteBuilder extends AbstractBuilder {
    const UPVOTES = '{{upVotes}}';
    const DOWNVOTES = '{{downVotes}}';
    const ARROWUP = '<arrowUp />';
    const ARROWDOWN = '<arrowDown />';
    const ARTICLEID = '{{articleId}}';
    const ARROWUPCOLORED = '{{imgPathUp}}';
    const ARROWDOWNCOLORED = '{{imgPathDown}}';

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
        if ($vote != "")
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
        if ($vote != "")
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
        $this->Params[VoteBuilder::ARROWUP] = file_get_contents(__DIR__ . '/../components/arrowUp.phtml');
        $this->Params[VoteBuilder::ARROWDOWN] = file_get_contents(__DIR__ . '/../components/arrowDown.phtml');
    }


    public function setUpVotesColored() {
        $this->Params[VoteBuilder::ARROWDOWNCOLORED] = '/apolato/img/dislike.png';
        $this->Params[VoteBuilder::ARROWUPCOLORED] = '/apolato/img/likePressed.png';
    }


    public function setDownVotesColored() {
        $this->Params[VoteBuilder::ARROWUPCOLORED] = '/apolato/img/like.png';
        $this->Params[VoteBuilder::ARROWDOWNCOLORED] = '/apolato/img/dislikePressed.png';
    }


    public function resetVotesColored() {
        $this->Params[VoteBuilder::ARROWDOWNCOLORED] = '/apolato/img/dislike.png';
        $this->Params[VoteBuilder::ARROWUPCOLORED] = '/apolato/img/like.png';
    }
}
