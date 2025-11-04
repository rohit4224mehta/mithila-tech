public function about()
{
    $team = [
        [
            'name' => 'Rohit Mehta',
            'role' => 'Founder & CEO',
            'image' => 'images/team/rohit.jpg',
            'bio' => 'Visionary behind Mithila Tech with a passion for empowering solutions.'
        ],
        [
            'name' => 'Anjali Sharma',
            'role' => 'COO',
            'image' => 'images/team/anjali.jpg',
            'bio' => 'Operational mastermind ensuring smooth execution and delivery.'
        ],
        [
            'name' => 'Kiran Joshi',
            'role' => 'Product Manager',
            'image' => 'images/team/kiran.jpg',
            'bio' => 'Bridges client needs with cutting-edge development strategies.'
        ],
    ];

    return view('pages.about', compact('team'));
}
