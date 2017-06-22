<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requirements;
use App\Mainrequirements;
use App\Ranks;
use App\User;

use App\UserHasReq;
use App\UserWantsChk;

use Redirect;

class checkController extends Controller
{
	public function index($requirementid, $userid)
	{
		$user = User::Find($userid);
		$requirement = Requirements::Find($requirementid);
		return view('check.index', ['user' => $user, 'requirement' =>$requirement]);
	}

	public function addCheckToAdminRow($requirementid, $userid)
	{
		$requirementName = Requirements::Find($requirementid);
		$userName = User::Find($userid);

		$chkForAdmin = new userWantsChk;
			$chkForAdmin->user_id = $userid;
			$chkForAdmin->user_name = $userName->name;
			$chkForAdmin->requirement_name = $requirementName->requirements_name;
			$chkForAdmin->requirement_id = $requirementid;
		$chkForAdmin->save();

		return Redirect::to('profile/' . $userid);
	}

    public function addUserHas($requirementid)
    {

    }
}
