<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of group module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     group
 * @version     $Id: model.php 4976 2013-07-02 08:15:31Z wyd621@gmail.com $
 * @link        http://www.ranzhico.com
 */
?>
<?php
class groupModel extends model
{
    /**
     * Create a group.
     * 
     * @access public
     * @return bool
     */
    public function create()
    {
        $group = fixer::input('post')->specialChars('name, desc')->get();
        return $this->dao->insert(TABLE_GROUP)->data($group)->batchCheck($this->config->group->create->requiredFields, 'notempty')->exec();
    }

    /**
     * Update a group.
     * 
     * @param  int    $groupID 
     * @access public
     * @return void
     */
    public function update($groupID)
    {
        $group = fixer::input('post')->specialChars('name, desc')->get();
        return $this->dao->update(TABLE_GROUP)->data($group)->batchCheck($this->config->group->edit->requiredFields, 'notempty')->where('id')->eq($groupID)->exec();
    }

    /**
     * Copy a group.
     * 
     * @param  int    $groupID 
     * @access public
     * @return void
     */
    public function copy($groupID)
    {
        $group = fixer::input('post')->specialChars('name, desc')->remove('options')->get();
        $this->dao->insert(TABLE_GROUP)->data($group)->check('name', 'unique')->check('name', 'notempty')->exec();
        if($this->post->options == false) return;
        if(!dao::isError())
        {
            $newGroupID = $this->dao->lastInsertID();
            $options    = join(',', $this->post->options);
            if(strpos($options, 'copyPriv') !== false) $this->copyPriv($groupID, $newGroupID);
            if(strpos($options, 'copyUser') !== false) $this->copyUser($groupID, $newGroupID);
        }
    }

    /**
     * Copy privileges.
     * 
     * @param  string    $fromGroup 
     * @param  string    $toGroup 
     * @access public
     * @return void
     */
    public function copyPriv($fromGroup, $toGroup)
    {
        $privs = $this->dao->findByGroup($fromGroup)->from(TABLE_GROUPPRIV)->fetchAll();
        foreach($privs as $priv)
        {
            $priv->group = $toGroup;
            $this->dao->insert(TABLE_GROUPPRIV)->data($priv)->exec();
        }
    }

    /**
     * Copy user.
     * 
     * @param  string    $fromGroup 
     * @param  string    $toGroup 
     * @access public
     * @return void
     */
    public function copyUser($fromGroup, $toGroup)
    {
        $users = $this->dao->findByGroup($fromGroup)->from(TABLE_USERGROUP)->fetchAll();
        foreach($users as $user)
        {
            $user->group = $toGroup;
            $this->dao->insert(TABLE_USERGROUP)->data($user)->exec();
        }
    }

    /**
     * Get group lists.
     * 
     * @access public
     * @return array
     */
    public function getList()
    {
        return $this->dao->select('*')->from(TABLE_GROUP)->orderBy('id')->fetchAll();
    }

    /**
     * Get group pairs.
     * 
     * @access public
     * @return array
     */
    public function getPairs()
    {
        return $this->dao->select('id, name')->from(TABLE_GROUP)->fetchPairs();
    }

    /**
     * Get group by id.
     * 
     * @param  int    $groupID 
     * @access public
     * @return object
     */
    public function getByID($groupID)
    {
        return $this->dao->findById($groupID)->from(TABLE_GROUP)->fetch();
    }

    /**
     * Get group by account.
     * 
     * @param  string    $account 
     * @access public
     * @return array
     */
    public function getByAccount($account)
    {
        return $this->dao->select('t2.*')->from(TABLE_USERGROUP)->alias('t1')
            ->leftJoin(TABLE_GROUP)->alias('t2')
            ->on('t1.group = t2.id')
            ->where('t1.account')->eq($account)
            ->fetchAll('id');
    }

    /**
     * Get privileges of a groups.
     * 
     * @param  int    $groupID 
     * @access public
     * @return array
     */
    public function getPrivs($groupID)
    {
        $privs = array();
        $stmt  = $this->dao->select('module, method')->from(TABLE_GROUPPRIV)->where('`group`')->eq($groupID)->orderBy('module')->query();
        while($priv = $stmt->fetch()) $privs[$priv->module][$priv->method] = $priv->method;
        return $privs;
    }

    /**
     * Get user pairs of a group.
     * 
     * @param  int    $groupID 
     * @access public
     * @return array
     */
    public function getUserPairs($groupID)
    {
        $users = $this->dao->select('t2.account, t2.realname, t2.realnames')
            ->from(TABLE_USERGROUP)->alias('t1')
            ->leftJoin(TABLE_USER)->alias('t2')->on('t1.account = t2.account')
            ->where('`group`')->eq((int)$groupID)
            ->orderBy('t2.account')
            ->fetchAll('account');

        $userPairs = array();
        foreach($users as $account => $user)
        {
            if(!$account) continue;
            $userPairs[$account] = $this->loadModel('user')->computeRealname($user);
        }
        return $userPairs;
    }

    /**
     * Delete a group.
     * 
     * @param  int    $groupID 
     * @param  null   $null      compatible with that of model::delete()
     * @access public
     * @return void
     */
    public function delete($groupID, $null = null)
    {
        $this->dao->delete()->from(TABLE_GROUP)->where('id')->eq($groupID)->exec();
        $this->dao->delete()->from(TABLE_USERGROUP)->where('`group`')->eq($groupID)->exec();
        $this->dao->delete()->from(TABLE_GROUPPRIV)->where('`group`')->eq($groupID)->exec();
    }

    /**
     * Update privilege of a group.
     * 
     * @param  int    $groupID 
     * @access public
     * @return bool
     */
    public function updatePrivByGroup($groupID)
    {
        /* Delete old. */
        $this->dao->delete()->from(TABLE_GROUPPRIV)->where('`group`')->eq($groupID)->exec();

        /* Insert new. */
        if($this->post->actions)
        {
            foreach($this->post->actions as $moduleName => $moduleActions)
            {
                foreach($moduleActions as $actionName)
                {
                    $data         = new stdclass();
                    $data->group  = $groupID;
                    $data->module = $moduleName;
                    $data->method = $actionName;
                    $this->dao->replace(TABLE_GROUPPRIV)->data($data)->exec();
                }
            }
        }
        return true;
    }

    /**
     * Update privilege by module.
     * 
     * @access public
     * @return void
     */
    public function updatePrivByModule()
    {
        if($this->post->module == false or $this->post->actions == false or $this->post->groups == false) return false;

        foreach($this->post->actions as $action)
        {
            foreach($this->post->groups as $group)
            {
                $data         = new stdclass();
                $data->group  = $group;
                $data->module = $this->post->module;
                $data->method = $action;
                $this->dao->replace(TABLE_GROUPPRIV)->data($data)->exec();
            }
        }
        return true;
    }

    /**
     * Update users.
     * 
     * @param  int    $groupID 
     * @access public
     * @return void
     */
    public function updateUser($groupID)
    {
        /* Delete old. */
        $this->dao->delete()->from(TABLE_USERGROUP)->where('`group`')->eq($groupID)->exec();

        /* Insert new. */
        if($this->post->members == false) return;
        foreach($this->post->members as $account)
        {
            $data          = new stdclass();
            $data->account = $account;
            $data->group   = $groupID;
            $this->dao->insert(TABLE_USERGROUP)->data($data)->exec();
        }
        return !dao::isError();
    }
}
