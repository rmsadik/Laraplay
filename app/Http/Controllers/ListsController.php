<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DrewM\MailChimp\MailChimp;

/**
 * List controller to interact with MailChimp API for basic CRUD functionality

 * MailChimp API v3: http://developer.mailchimp.com
 * This wrapper: https://github.com/drewm/mailchimp-api
 *
 * @author Mohamed Sathik <mhmd.sathik@gmail.com>
 * @version 1.0
 */
class ListsController extends Controller
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

    protected $apiKey = '512a71fecfbe3fe4c0b8e4e96b69ebfa-us17';

    /**
     * Constructor
     */
    public function __construct() 
    {
        $this->MailChimp = new MailChimp($this->apiKey);
    }
    
    /**
     * Displays all lists for the given API key
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mailchimp = $this->MailChimp->get('lists');
        $lists = $mailchimp['lists'];

        return view('list.index', compact('lists'));
    }

    /**
     * Shows the form for creating a new member.
     *
     * @param int listId
     * @return \Illuminate\Http\Response
     */
    public function create($listId)
    {
        return view('list.create', compact('listId'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lisId
     *
     * @return \Illuminate\Http\Response
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
     *
     * @param  int  $lisId
     * @return \Illuminate\Http\Response
     */
    public function show($listId)
    {
        $list = $this->MailChimp->get("lists/$listId/members");
        $members = $list['members'];

        return view('list.show', compact('members','listId'));
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
 
        return view('list.edit', compact('member'));
    }

    /**
     * Update the  member from the list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $listId
     * @param  string  $emailId
     * @return list of members | error message
     */
    public function update(Request $request, $listId, $emailId)
    {
        $subscriberHash = $this->MailChimp->subscriberHash($emailId);
        $result = $this->MailChimp->patch("lists/$listId/members/$subscriberHash", [
                        'merge_fields' => ['FNAME'=>$request['fname'], 'LNAME'=>$request['lname']],
                    ]);
        
        return $this->show($listId);
    }

    /**
     * Delete a member from the list.
     *
     * @param  int  $listId
     * @param  string  $emailId

     * @return list of members | error message
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
