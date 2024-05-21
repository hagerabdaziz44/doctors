<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PushNotification;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    public function index()
    {
        $notifications = PushNotification::orderBy('created_at', 'desc')->paginate(25);
        return view('dashboard.notifications.index', compact('notifications'));
    }
    public function bulksend(Request $req)
    {
        $comment = new PushNotification();
        $comment->title = $req->input('title');
        $comment->body = $req->input('body');

        $comment->save();
        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $req->id, 'status' => "done");
        $notification = array('title' => $req->title, 'body' => $req->body, 'sound' => 'default', 'badge' => '1',);
        $arrayToSend = array('to' => "/topics/all", 'notification' => $notification, 'data' => $dataArr, 'priority' => 'high');
        $fields = json_encode($arrayToSend);
        $headers = array(
            'Authorization: key=' . "AAAA5NDkj8g:APA91bGae1O67mQTRnn5y6D-6C7NnvW_9HcFr4cg4vdtMnaaCI2kh0zPpo6zdcf3nKfkM-vNaulRezfNZ2MKDLKKEDbk24hWuSQs88PzMhOuf6Udbxdsr-kAHqYbV0nkjyIsyDDrazO5",
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        //var_dump($result);
        curl_close($ch);

        return redirect()->route('notifications.index')->with(['success' => 'added successfully']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.notifications.create');
    }
    public function delete($id)
    {
        $notifications = PushNotification::find($id);
        $notifications->delete();

        return redirect()->route('notifications.index')->with(['success' => 'deleted successfully']);
    }
    // public function Patient_notifications_create()
    // {

    // }
}
