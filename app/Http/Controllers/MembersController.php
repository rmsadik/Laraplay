<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DrewM\MailChimp\MailChimp;

/**
 * Members controller to interact with MailChimp API for basic members CRUD functionality

 * MailChimp API v3: http://developer.mailchimp.com
 * This wrapper: https://github.com/drewm/mailchimp-api
 *
 * @author Mohamed Sathik <mhmd.sathik@gmail.com>
 * @version 1.0
 */
class MembersController extends Controller
{
    /**
     * MailChimp Oject.
     */
    protected $MailChimp;

    /**
     * Fillable array to whitelist the form input fields
     * Laraval array $fillable
     */
    protected $fillable = ['fname', 'lname', 'email'];

    /**
     * Constructor
     */
    public function __construct() 
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['mailchimp_apikey']))
        {
            $noAPI = true;
            return view('list.index', compact('noAPI'));
        }
        $this->MailChimp = new MailChimp($_SESSION['mailchimp_apikey']);

    }

    /**
     * Index page for Members
     */
    public function index()
    {
        //
    }

    /**
     * Shows the form for creating a new member.
     *
     * @param int listId
     * @return \Illuminate\Http\Response
     */
    public function create($listId)
    {
        return view('list.member.create', compact('listId'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param $listId
     * @return array|false|\Illuminate\Http\Response
     */
    public function store(Request $request, $listId)
    {
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',

        ]);

        $result = $this->MailChimp->post("lists/$listId/members", [
                'email_address' => $request['email'],
                'merge_fields' => ['FNAME'=>$request['fname'], 'LNAME'=>$request['lname']],
                'status'        => 'subscribed',
            ]);


        if ($this->MailChimp->success()) {
            return $this->show($listId);
        } else {
            return $this->MailChimp->getLastError();
        }

    }

    /**
     * Display all members from the list.
     * @param $listId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($listId)
    {
        $list = $this->MailChimp->get("lists/$listId/members");
        $members = $list['members'];

        return view('list.member.show', compact('members','listId'));
    }

    /**
     * Show the form for editing the specified member.
     *
     * @param  int  $listId
     * @param  string  $emailId
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($listId, $emailId)
    {
        $subscriberHash = $this->MailChimp->subscriberHash($emailId);
        $member = $this->MailChimp->get("lists/$listId/members/$subscriberHash");
 
        return view('list.member.edit', compact('member'));
    }

    /**
     * Update the  member from the list.
     * @param Request $request
     * @param $listId
     * @param $emailId
     * @return array|false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, $listId, $emailId)
    {
        $subscriberHash = $this->MailChimp->subscriberHash($emailId);
        $this->MailChimp->patch("lists/$listId/members/$subscriberHash", [
                        'merge_fields' => ['FNAME'=>$request['fname'], 'LNAME'=>$request['lname']],
                    ]);
        if ($this->MailChimp->success()) {
            return $this->show($listId);
        } else {
            return $this->MailChimp->getLastError();
        }
    }

    /**
     * Delete a member from the list.
     * @param $listId
     * @param $emailId
     * @return array|false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy($listId, $emailId)
    {
        $subscriber_hash = $this->MailChimp->subscriberHash($emailId);
        $this->MailChimp->delete("lists/$listId/members/$subscriber_hash");

       if ($this->MailChimp->success()) {
            return $this->show($listId);
        } else {
            return $this->MailChimp->getLastError();
        }
    }
}
