<?php

namespace App\Modules\Kagi\Http\Presenters;

use Laracasts\Presenter\Presenter;

use DB;


class Kagi extends Presenter {

	/**
	 * name
	 *
	 * @return string
	 */
	public function name()
	{
		return ucwords($this->entity->name);
	}


	/**
	 * email
	 *
	 * @return string
	 */
	public function email()
	{
		return $this->entity->email;
	}


	/**
	 * banned checkbox
	 *
	 * @return string
	 */
	public function banned()
	{
//dd("loaded");
		$return = '';
//		return $this->entity->active ? trans('lingos::general.yes') : trans('lingos::general.no');

		$banned = $this->entity->banned;
		if ( $banned == 1 ) {
			$return = "checked";
		}

		return $return;
	}


	/**
	 * blocked checkbox
	 *
	 * @return string
	 */
	public function blocked()
	{
//dd("loaded");
		$return = '';
		$blocked = $this->entity->blocked;
		if ( $blocked == 1 ) {
			$return = "checked";
		}

		return $return;
	}


	/**
	 * confirmed checkbox
	 *
	 * @return string
	 */
	public function confirmed()
	{
//dd("loaded");
		$return = '';
		$confirmed = $this->entity->confirmed;
		if ( $confirmed == 1 ) {
			$return = "checked";
		}

		return $return;
	}


	/**
	 * activated checkbox
	 *
	 * @return string
	 */
	public function activated()
	{
//dd("loaded");
		$return = '';
		$activated = $this->entity->activated;
		if ( $activated == 1 ) {
			$return = "checked";
		}

		return $return;
	}


	/**
	 * activated checkbox
	 *
	 * @return string
	 */
	public function allow_direct()
	{
//dd("loaded");
		$return = '';
		$allow_direct = $this->entity->allow_direct;
		if ( $allow_direct == 1 ) {
			$return = "checked";
		}

		return $return;
	}


	/**
	 * banned icon
	 *
	 * @return string
	 */
	public function iconBanned()
	{
//dd("loaded");
		$return = '';
		$banned = $this->entity->banned;

		if ( $banned == 1 ) {
			$return = '<span class="glyphicon glyphicon-ok text-success"></span>';
		} else {
			$return = '<span class="glyphicon glyphicon-remove text-danger"></span>';
		}

		return $return;
	}


	/**
	 * blocked icon
	 *
	 * @return string
	 */
	public function iconBlocked()
	{
//dd("loaded");
		$return = '';
		$blocked = $this->entity->blocked;

		if ( $blocked == 1 ) {
			$return = '<span class="glyphicon glyphicon-ok text-success"></span>';
		} else {
			$return = '<span class="glyphicon glyphicon-remove text-danger"></span>';
		}

		return $return;
	}


	/**
	 * confirmed icon
	 *
	 * @return string
	 */
	public function iconConfirmed()
	{
//dd("loaded");
		$return = '';
		$confirmed = $this->entity->confirmed;

		if ( $confirmed == 1 ) {
			$return = '<span class="glyphicon glyphicon-ok text-success"></span>';
		} else {
			$return = '<span class="glyphicon glyphicon-remove text-danger"></span>';
		}

		return $return;
	}


	/**
	 * activated icon
	 *
	 * @return string
	 */
	public function iconActivated()
	{
//dd("loaded");
		$return = '';
		$activated = $this->entity->activated;

		if ( $activated == 1 ) {
			$return = '<span class="glyphicon glyphicon-ok text-success"></span>';
		} else {
			$return = '<span class="glyphicon glyphicon-remove text-danger"></span>';
		}

		return $return;
	}


	/**
	 * activated icon
	 *
	 * @return string
	 */
	public function iconAllowDirect()
	{
//dd("loaded");
		$return = '';
		$allow_direct = $this->entity->allow_direct;

		if ( $allow_direct == 1 ) {
			$return = '<span class="glyphicon glyphicon-ok text-success"></span>';
		} else {
			$return = '<span class="glyphicon glyphicon-remove text-danger"></span>';
		}

		return $return;
	}


	/**
	 * roles
	 *
	 * @return string
	 */
	public function roles()
	{
		$roles = $this->entity->roles;
		$return = '';
//dd($roles);
		foreach ($roles as $role)
		{
			$return .= $role->present()->name() . ', ';
		}

		if (empty($return))
		{
			$return = trans('lingos::general.none');
		}

		return trim($return, ', ');
	}


	public function profileFirstName($user_id)
	{
		$user = DB::table('profiles')
			->where('user_id', '=', $user_id)
			->pluck('first_name');
		$user = strtoupper($user);

		return $user;
	}


// JINJI


	public function jobTitleName($job_title_id, $locale_id)
	{
		$jobtitle = DB::table('job_title_translations')
			->where('locale_id', '=', $locale_id)
			->where('id', '=', $job_title_id, 'AND')
			->pluck('name');
		if ( empty($jobtitle) ) {
			return trans('kotoba::general.none');
		} else {
			return $jobtitle;
		}
	}


	public function SubjectName($subject_id, $locale_id)
	{
		$subject = DB::table('subject_translations')
			->where('locale_id', '=', $locale_id)
			->where('id', '=', $subject_id, 'AND')
			->pluck('name');
		if ( empty($subject) ) {
			return trans('kotoba::general.none');
		} else {
			return $subject;
		}
	}




	public function employeeName($user_id)
	{
		$employee = DB::table('profiles')
			->where('user_id', '=', $user_id)
			->select('last_name', 'first_name', 'middle_initial')
			->first();
//dd($user_id);

		if ( count($employee) ) {
			return $employee->last_name . ',&nbsp;' . $employee->first_name . '&nbsp;' . $employee->middle_initial;
		} else {
			return trans('kotoba::general.none');
		}

	}


	public function employeeEmail($user_id)
	{
		$employee = DB::table('profiles')
			->where('user_id', '=', $user_id)
			->pluck('email_1');
//dd($employee);

		if ( count($employee) ) {
			return $employee;
		} else {
			return trans('kotoba::general.none');
		}

	}


	public function employeeJobTitle($user_id, $locale_id)
	{
		$job_title_id = DB::table('employees')
			->where('user_id', '=', $user_id)
			->pluck('job_title_id');
//dd($employee);
		$employee = $this->jobTitleName($job_title_id, $locale_id);

		if ( count($employee) ) {
			return $employee;
		} else {
			return trans('kotoba::general.none');
		}

	}


	public function employeeSubjects($user_id, $locale_id)
	{
		$subjects = DB::table('subject_user')
			->where('user_id', '=', $user_id)
			->get();
//dd($subjects);

		$all_subjects = '';
		if ( count($subjects) ) {
			foreach( $subjects as $subject)
			{
//dd($subject);
				$all_subjects = $this->SubjectName($subject->subject_id, $locale_id) . ',&nbsp;' . $all_subjects;
			}
			return trim($all_subjects, ',&nbsp;');
		} else {
			return trans('kotoba::general.none');
		}

	}




}
