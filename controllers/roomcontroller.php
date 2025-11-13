<?php 

class Roomcontroller{
    public function createRoom($roomName, $capacity, $location ){
        global $connections;

        $sql = "INSERT INTO room_tbl (roomName, capacity, location) VALUES ('$roomName', $capacity, '$location')";
        $result = mysqli_query($connections, $sql);

     if ($result) {
        echo "
        <script>
            alert('Room Added successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error Adding Room: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    }
    }

    public function modifyRoom($roomID, $roomName, $capacity, $location, $roomStatus){
         global $connections;

         $sql = "UPDATE room_tbl SET roomName = '$roomName', capacity = $capacity, location = '$location',
          roomStatus = '$roomStatus' WHERE roomID = $roomID";
         $result = mysqli_query($connections, $sql);

           if ($result) {
        echo "
        <script>
            alert('Room Modified successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error updating Room: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    }


    }

    public function deleteRoom($roomID){
         global $connections;

         $sql = "DELETE FROM room_tbl WHERE roomID = $roomID";
         $result = mysqli_query($connections, $sql);

            if ($result) {
        echo "
        <script>
            alert('Room Deleted successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error Removing Room: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    }
    }

    public function fetchRoom (){
        global $connections;

        $sql = "SELECT * FROM room_tbl";
        $result = mysqli_query($connections, $sql);

        $roomList = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                   $roomList[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $roomList;
    }

    public function fetchRoomCounts() {
    global $connections;

    $sql = "SELECT 
                COUNT(*) AS totalRooms,
                SUM(CASE WHEN roomStatus = 'Available' THEN 1 ELSE 0 END) AS availableRooms,
                SUM(CASE WHEN roomStatus = 'Occupied' THEN 1 ELSE 0 END) AS occupiedRooms,
                SUM(CASE WHEN roomStatus = 'Maintenance' THEN 1 ELSE 0 END) AS underMaintenance
            FROM room_tbl";

    $result = mysqli_query($connections, $sql);

    if($result && mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result); // returns an associative array with counts
    } else {
        return [
            'totalRooms' => 0,
            'availableRooms' => 0,
            'occupiedRooms' => 0,
            'underMaintenance' => 0
        ];
    }
}

}