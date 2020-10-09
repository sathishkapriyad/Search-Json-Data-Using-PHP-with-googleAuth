<?php 
$organizations = json_decode(file_get_contents('assets/json/jsonStore/organizations.json'), true);
$tickets = json_decode(file_get_contents('assets/json/jsonStore/tickets.json'), true);
$users = json_decode(file_get_contents('assets/json/jsonStore/users.json'), true);

switch ($_GET['tab']) {
    case 'organization':
        echo getOrganizationData($_GET['q'], $organizations, $tickets, $users);
        break;
    case 'users':
        echo getUsers($_GET['q'], $organizations, $tickets, $users);
        break;
    case 'tickets': 
        echo getTickets($_GET['q'], $organizations, $tickets, $users);
        break;    
    default:
        # code...
        break;
}

// Filter Organization data and return the list
function getOrganizationData($search, $organizations, $tickets, $users) {
    $organizationsList = $organizations;
    if($search) {
        $organizationsList = array_filter($organizations, function ($v) use($search) {
            return $v['name'] == $search;
        });
    }
    $organizationsLists = [];
    try{
        foreach ($organizationsList as $key => $value) {
            $organizationsLists[$key]['name'] = $value['name']; 
            $ticketList = array_filter($tickets, function ($v) use($value) {
                return isset($v['organization_id']) && $v['organization_id'] == $value['_id'];
            });
            foreach ($ticketList as $key1 => $ticket) {
                $organizationsLists[$key]['subject'] = isset($ticket['subject']) ? $ticket['subject'] : 'N/A';
                $usersList = [];
                foreach ($users as $key2 => $user) {
                    if(isset($user['organization_id']) && isset($ticket['assignee_id']) && $user['organization_id'] == $value['_id'] && $user['_id'] === $ticket['assignee_id']) {
                        $usersList = $user;
                        break;  
                    } else if(isset($user['organization_id']) && isset($ticket['assignee_id']) && $user['organization_id'] ==   $value['_id'] && $user['_id'] === $ticket['submitter_id']) {
                        $usersList = $user;
                        break;
                    }
                }
                $organizationsLists[$key]['user_name'] = isset($usersList['name']) ? $usersList['name'] : 'N/A';
            }
        }
    } catch (Exception $e) {
        return "No Data found";
        
    } 
    // return "<pre> heelo";
    return renderHTML($organizationsLists);
}

// Function for get users with assigned ticket & submitted ticket
function getUsers($search, $organizations, $tickets, $users) {
    $usersList = $users;
    if($search) {
        $usersList = array_filter($users, function ($v) use($search) {
            return $v['name'] == $search;
        });
    }
    $usersLists = [];
    try{
        foreach ($usersList as $key => $value) {
            $usersLists[$key]['name'] = $value['name'];
            $organization = [];
            foreach($organizations as $k2 => $org) {
                if(isset($value['organization_id']) && $org['_id'] == $value['organization_id']) {
                    $organization = $org;
                    break;
                }
            } 
            $usersLists[$key]['subject'] = isset($organization['name']) ? $organization['name'] : 'N/A';
            $usersLists[$key]['assignee_subject'] = '';
            $usersLists[$key]['submited_subject'] = '';
            foreach($tickets as $k3 => $ticket) {
                if($ticket['submitter_id'] == $value['_id']) {
                    $usersLists[$key]['submited_subject'] .= $ticket['subject'] . ', '; 
                }
                if(isset($ticket['assignee_id']) && $ticket['assignee_id'] == $value['_id']) {
                    $usersLists[$key]['assignee_subject'] .= $ticket['subject'] . ', '; 
                }
            }
        }
    } catch (Exception $e) {
        return "No Data found";
    } 
    // return "<pre> heelo";
    return renderUserHTML($usersLists);
}

function getTickets($search, $organizations, $tickets, $users) {
    $ticketsList = $tickets;
    if($search) {
        $ticketsList = array_filter($tickets, function ($v) use($search) {
            return $v['subject'] == $search;
        });
    }
    $usersLists = [];
    try{
        foreach ($ticketsList as $key => $value) {
            $usersLists[$key]['subject'] = $value['subject'];
            $organization = [];
            foreach($organizations as $k2 => $org) {
                if(isset($value['organization_id']) && $org['_id'] == $value['organization_id']) {
                    $organization = $org;
                    break;
                }
            } 
            $usersLists[$key]['name'] = isset($organization['name']) ? $organization['name'] : 'N/A';
            $usersLists[$key]['assignee_name'] = '';
            $usersLists[$key]['submited_name'] = '';
            foreach($users as $k3 => $user) {
                if($value['submitter_id'] == $user['_id']) {
                    $usersLists[$key]['submited_name'] .= $user['name'] . ', '; 
                }
                if(isset($value['assignee_id']) && $value['assignee_id'] == $user['_id']) {
                    $usersLists[$key]['assignee_name'] .= $user['name'] . ', '; 
                }
            }
        }
    } catch (Exception $e) {
        return "No Data found";
    } 
    // return "<pre> heelo";
    return renderTicketHTML($usersLists);
}

function renderHTML($lists) {
    $html = '';
    foreach($lists as $key => $list) {
        $html.= "<div class='card mb-2 mt-2'>
                    <div class='card-header'>" . $list['name'] . "</div>
                    <div class='card-body'>
                        <h5 class='card-title'> Subject: " .$list['subject'] . "</h5>
                        <p class='card-text'>
                         User: ". $list['user_name'] . " 
                        </p>
                    </div>
                </div>";
    }
    return $html;
}

// Function for generate html of users with assigned ticket & submitted ticket
function renderUserHTML($lists) {
    $html = '';
    foreach($lists as $key => $list) {
        $html.= "<div class='card mb-2 mt-2'>
                    <div class='card-header'>" . $list['name'] . "</div>
                    <div class='card-body'>
                        <h5 class='card-title'> Organization: " .$list['subject'] . "</h5>
                        <p class='card-text'>
                         Assignee Ticket: ". $list['assignee_subject'] . " 
                        </p>
                        <p class='card-text'>
                         Submitted Ticket: ". $list['submited_subject'] . " 
                        </p>
                    </div>
                </div>";
    }
    return $html;
}

// Function for generate html of tickets with assigned name & submitted name
function renderTicketHTML($lists) {
    $html = '';
    foreach($lists as $key => $list) {
        $html.= "<div class='card mb-2 mt-2'>
                    <div class='card-header'>" . $list['subject'] . "</div>
                    <div class='card-body'>
                        <h5 class='card-title'> Organization: " .$list['name'] . "</h5>
                        <p class='card-text'>
                         Assignee Name: ". $list['assignee_name'] . " 
                        </p>
                        <p class='card-text'>
                         Submitted Name: ". $list['submited_name'] . " 
                        </p>
                    </div>
                </div>";
    }
    return $html;
}