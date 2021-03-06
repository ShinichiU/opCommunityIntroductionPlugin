<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * MobileFrontendCommunityIntroductionMessageForm form.
 *
 * @package    opCommunityIntroductionPlugin
 * @subpackage form
 * @author     Masato Nagasawa <nagasawa@tejimaya.com>
 */
class MobileFrontendCommunityIntroductionMessageForm extends BaseCommunityIntroductionMessageForm
{
  protected function setWidgetOfFriendsMember()
  {
    $size = sfConfig::get('app_community_introduction_mobile_choice_friend_size', 5);

    $allMemberIds = opCommunityIntroductionPlugin::getNotJoinCommunityFriendMemberIds(
      $this->community->getId(), sfContext::getInstance()->getUser()->getMember());
    $memberList = opCommunityIntroductionPlugin::getNotJoinCommunityFriendMembers(
      $this->community->getId(), sfContext::getInstance()->getUser()->getMember(), $size, true);

    $memberNames = array();
    foreach ($memberList as $member)
   {
      $memberNames[$member->getId()] = $member->getName();
    }
    $this->setWidget('member_id_list', new sfWidgetFormChoice(array('choices' => $memberNames)));
    $this->setValidator('member_id_list', new sfValidatorChoice(array('choices' => $allMemberIds)));
  }
}
