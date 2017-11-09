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
    protected $fillable = ['fname', 'lname', 'email', 'listname', 'apiKey'];

    protected $apiKey = '';

    protected $url = "us17.api.mailchimp.com/3.0/lists/";


    /**
     * Constructor
     */
    public function __construct() 
    {
        session_start();
    }
    
    /**
     * Displays all lists for the given API key
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $noAPI = $invalidApiKey =  false;
        if(isset($request['apiKey']))
        {
            $this ->apiKey = $_SESSION['mailchimp_apikey'] = $request['apiKey'];
        }

        if(!isset($_SESSION['mailchimp_apikey']) || empty($this->apiKey))
        {
            $noAPI = true;
            return view('list.index', compact('invalidApiKey','noAPI'));
        }
        $this->MailChimp = new MailChimp($this->apiKey);
        $mailchimp = $this->MailChimp->get('lists');
        if(isset($mailchimp['status']) && $mailchimp['status'] == 401)
        {
            $invalidApiKey = $noAPI = true;
            return view('list.index', compact('invalidApiKey','noAPI'));
        }
        $lists = $mailchimp['lists'];

        return view('list.index', compact('lists', 'invalidApiKey','noAPI'));
    }

    /**
     * Shows the form for creating a new member.
     *
     * @param int listId
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('list.create');

    }

     /**
     * Store a newly created list.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $name = $request['listname'];
        $data = '{"name":"'.$name.'","contact":{"company":"MailChimp","address1":"675 Ponce De Leon Ave NE","address2":"Suite 5000","city":"Atlanta","state":"GA","zip":"30308","country":"US","phone":""},"permission_reminder":"You are receiving this email because you signed up for updates about Freds newest hats.","campaign_defaults":{"from_name":"Freddie","from_email":"fredddddie@freddiehats.com","subject":"","language":"en"},"email_type_option":true}';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, "anystring" . ":" . $this->apiKey);

        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_exec($ch);

        if (curl_errno($ch))
        {
            return 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return redirect("/");

    }

    /**
     * Display all members from the list.
     *
     * @param  int  $lisId
     * @return \Illuminate\Http\Response
     */
    public function show($listId)
    {
    //     $list = $this->MailChimp->get("lists/$listId/members");
    //     $members = $list['members'];

    //     return view('list.show', compact('members','listId'));
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
    //     $subscriberHash = $this->MailChimp->subscriberHash($emailId);
    //     $member = $this->MailChimp->get("lists/$listId/members/$subscriberHash");
 
    //     return view('list.edit', compact('member'));
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
        // $subscriberHash = $this->MailChimp->subscriberHash($emailId);
        // $result = $this->MailChimp->patch("lists/$listId/members/$subscriberHash", [
        //                 'merge_fields' => ['FNAME'=>$request['fname'], 'LNAME'=>$request['lname']],
        //             ]);
        
        // return $this->show($listId);
    }


    /**
     * Delete a list
     *
     * @param $listId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function destroy($listId)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url . $listId);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        curl_setopt($ch, CURLOPT_USERPWD, "anystring" . ":" . $this->apiKey);

        curl_exec($ch);
        if (curl_errno($ch)) {
            return 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

        return redirect("/");

    }
}
