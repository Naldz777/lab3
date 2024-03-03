<?php

namespace App\Controllers;

use App\Models\GuestsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Guests extends BaseController
{
    public function index()
    {
        $model = model(GuestsModel::class);

		$data = [
            'guests'  => $model->getGuests(),
            'title' => 'Guests Lists',
        ];

        return view('templates/guestsheader', $data)
            . view('guests/index')
            . view('templates/guestsfooter');
    }

    public function show($email = null)
    {
        $model = model(GuestsModel::class);
        $data['guests'] = $model->getGuests($slug);

        if (empty($data['guests'])) {
            throw new PageNotFoundException('Cannot find the guests item: ' . $slug);
        }

        $data['title'] = $data['guests']['title'];
        return view('templates/guestsheader', $data)
            . view('guests/view')
            . view('templates/guestsfooter');			
    }
}