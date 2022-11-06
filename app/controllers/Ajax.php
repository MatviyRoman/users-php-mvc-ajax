<?php
class Ajax extends Controller
{
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json; charset=utf-8");

        // init model User
        $user = $this->model('User');
        $user_id = (int) $_POST['user_id'] ?? false;
        $type = (string) $_GET['type'] ?? false;
        $result = [];

        $fname = htmlentities($this->xssClean($_POST['inputFName']));
        $lname = htmlentities($this->xssClean($_POST['inputLName']));
        $role  = (int) $_POST['inputRole'];

        switch ($type) {
            case 'delete':
                if ($user->delete((int) $user_id)) {
                    $result['status'] = 'success';
                } else {
                    $result['status'] = 'error';
                }
                break;

            case 'save':
                if (empty($fname) || empty($lname) || empty((int) $role)) {
                    $result['status'] = 'error';
                    $result['info'] = '';

                    if (empty($fname)) {
                        $result['info'] .= '<p>Empty first name</p>';
                    }

                    if (empty($lname)) {
                        $result['info'] .= '<p>Empty last name</p>';
                    }

                    if (empty((int) $role)) {
                        $result['info'] .= '<p>Empty role</p>';
                    }
                } else if ($user->save((int) $user_id, $fname, $lname, (int) $role)) {
                    $result['status'] = 'success';
                }

                break;

            case 'loadContent':
                $info = $user->getAll();

                $users = $info['result'];

                if (!empty($users)) {
                    foreach ($users as $user) {
?>
                        <li class="user list-group-item col-12 border-0" data-user-id="<?= $user->id ?>">
                            <?= $user->fname . ' ' . $user->lname ?> (<?= $user->role ?>)
                            <span class="btn btn-success edit">Edit</span>
                            <span class="btn btn-danger delete">Delete</span>
                        </li>
<?php
                    }
                    exit;
                }

                break;

            case 'getUserInfo':
                $user = $user->getOne((int) $user_id);

                if (is_object($user) && (int) $user->id) {
                    $result['status'] = 'success';
                    $result['user'] = (array)$user;
                } else {
                    $result['status'] = 'error';
                }

                break;

            default:
                $result['status'] = 'access denied';
                break;
        }

        echo json_encode($result);
    }
}
