<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DrewM\MailChimp\MailChimp;



//https://github.com/drewm/mailchimp-api
class ListsController extends Controller
{
    
    protected $MailChimp;
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
        //05d6863df1
        $mailchimp = $this->MailChimp->get('lists');
        $lists = $mailchimp['lists'];
// dd($lists);
        return view('list.index', compact('lists'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

// dd($members);
        return view('list.show', compact('members'));
       //
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
    public function update(Request $request, $listId)
    {
        $list_id = 'b1234346';
        $subscriber_hash = $MailChimp->subscriberHash('davy@example.com');

        // $result = $MailChimp->patch("lists/$list_id/members/$subscriber_hash", [
        //                 'merge_fields' => ['FNAME'=>'Davy', 'LNAME'=>'Jones'],
        //                 'interests'    => ['2s3a384h' => true],
        //             ]);     
        
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
