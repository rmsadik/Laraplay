<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DrewM\MailChimp\MailChimp;



//https://github.com/drewm/mailchimp-api
class ListsController extends Controller
{
    
    protected $MailChimp;
    protected $fillable = ['fname', 'lname', 'email'];
    public function __construct() 
    {
        $this->MailChimp = new MailChimp('512a71fecfbe3fe4c0b8e4e96b69ebfa-us17');
    }
    
    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     *
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = $this->MailChimp->get("lists/$id/members");
        $members = $list['members'];

        return view('list.show', compact('members'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($listId, $emailId)
    {
        $subscriberHash = $this->MailChimp->subscriberHash($emailId);
        $member = $this->MailChimp->get("lists/$listId/members/$subscriberHash");
 
        return view('list.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
