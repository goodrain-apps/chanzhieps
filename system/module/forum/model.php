<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of forum module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class forumModel extends model
{
    /**
     * Get boards.
     * 
     * @access public
     * @return array
     */
    public function getBoards()
    {
        $boards = array();
        $rawBoards = $this->dao->select('*')
            ->from(TABLE_CATEGORY)
            ->where('type')->eq('forum')
            ->orderBy('grade, `order`')
            ->fetchGroup('parent');
        if(!isset($rawBoards[0])) return $boards;

        foreach($rawBoards[0] as $parentBoard)
        {
            if(isset($rawBoards[$parentBoard->id]))
            {
                $parentBoard->children = $rawBoards[$parentBoard->id];
                foreach($parentBoard->children as $childBoard) 
                {
                    $childBoard->lastPostReplies = isset($replies[$childBoard->postID]) ? $replies[$childBoard->postID] : 0;
                    $childBoard->moderators      = explode(',', trim($childBoard->moderators, ','));
                }
                $boards[] = $parentBoard;
            }
        }

        $speakers = array();
        foreach($boards as $parentBoard)
        {
            foreach($parentBoard->children as $childBoard)
            {
                foreach($childBoard->moderators as $moderators) $speakers[] = $moderators;
                $speakers[] = $childBoard->postedBy;
            }
        }
        $speakers = $this->loadModel('user')->getRealNamePairs($speakers);
        foreach($boards as $parentBoard)
        {
            foreach($parentBoard->children as $childBoard) 
            {
                foreach($childBoard->moderators as $key => $moderators) $childBoard->moderators[$key] = isset($speakers[$moderators]) ? $speakers[$moderators] : '';
                $childBoard->postedByRealname = !empty($childBoard->postedBy) ? $speakers[$childBoard->postedBy] : '';
            }
        }

        return $boards;
    }

    /**
     * Update stats of forum.
     * 
     * @access public
     * @return void
     */
    public function updateStats()
    {
        $boards = $this->dao->select('id')->from(TABLE_CATEGORY)->where('grade')->eq(2)->andWhere('type')->eq('forum')->fetchAll();
        foreach($boards as $board) $this->updateBoardStats($board->id);
    }

    /**
     * Update status of boards.
     * 
     * @param  int    $boardID 
     * @access public
     * @return void
     */
    public function updateBoardStats($boardID)
    {
        /* Get threads and replies. */
        $stats = $this->dao->select('COUNT(id) as threads, SUM(replies) as replies')->from(TABLE_THREAD)
            ->where('board')->eq($boardID)
            ->andWhere('status')->ne('wait')
            ->andWhere('addedDate')->le(helper::now())
            ->andWhere('hidden')->eq('0')
            ->fetch();

        /* Get postID and replyID. */
        $post = $this->dao->select('id as postID, replyID, repliedDate as postedDate, repliedBy, author')->from(TABLE_THREAD)
            ->where('board')->eq($boardID)
            ->andWhere('addedDate')->le(helper::now())
            ->andWhere('hidden')->eq('0')
            ->orderBy('repliedDate desc')
            ->limit(1)
            ->fetch();

        $data = new stdclass();
        $data->threads = $stats->threads;
        $data->posts   = $stats->threads + $stats->replies;
        if($post)
        {
            $data->postID     = $post->postID;
            $data->replyID    = $post->replyID;
            $data->postedDate = $post->postedDate;
            $data->postedBy   = $post->repliedBy ? $post->repliedBy : $post->author;
        }
        else
        {
            $data->postID   = 0;
            $data->replyID  = 0;
            $data->postedBy = '';
        } 

        $this->dao->setAutoLang(false)->update(TABLE_CATEGORY)->data($data)->where('id')->eq($boardID)->exec();
    }

    /**
     * Judge a board is new or not.
     * 
     * @param string $board 
     * @access public
     * @return void
     */
    public function isNew($board)
    {
        return (time() - strtotime($board->postedDate)) < 24 * 60 * 60 * $this->config->forum->newDays;
    }

    /**
     * Judge a user can post thread to a board or not.
     * 
     * @param  object    $board 
     * @access public
     * @return void
     */
    public function canPost($board)
    {
        /* If the board is an open one, return true. */
        if($board->readonly == false) return true;

        /* Then check the user is admin or not. */
        if($this->app->user->admin == 'super') return true; 

        /* Then check the user is a moderator or not. */
        $user = ",{$this->app->user->account},";
        $moderators = ',' . str_replace(' ', '', $board->moderators) . ',';
        if(strpos($moderators, $user) !== false) return true;

        return false;
    }

    /**
     * Saving setting in config table. 
     * 
     * @access public
     * @return bool 
     */
    public function saveSetting()
    {
        $setting = new stdclass();
        $setting->postReview = $this->post->postReview; 
        $this->loadModel('setting')->setItems('system.common.forum', $setting);
        return !dao::isError();
    }
}
