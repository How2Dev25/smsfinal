<?php 

class TimeblockController {
    public function create( $blockName, $startTime, $endTime){
            global $connections;

            $sql = "INSERT INTO timeblocks (blockName, startTime, endTime) VALUES ('$blockName', '$startTime', '$endTime')";
            $result = mysqli_query($connections, $sql);

                    if ($result) {
                            echo "<script>alert('Timeblock Added'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        } else {
                            $error = addslashes(mysqli_error($connections));
                            echo "<script>alert('Timeblock Error: $error'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        }
             }


              public function update( $blockName, $startTime, $endTime, $timeblockID){
            global $connections;

                $sql = "UPDATE timeblocks SET blockName = '$blockName', startTime = '$startTime', endTime = '$endTime' WHERE timeblockID = $timeblockID";
            $result = mysqli_query($connections, $sql);

                    if ($result) {
                            echo "<script>alert('Timeblock Modified'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        } else {
                            $error = addslashes(mysqli_error($connections));
                            echo "<script>alert('Timeblock Error: $error'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        }
             }

             public function delete($timeblockID){
                    global $connections;

                    $sql = "DELETE FROM timeblocks WHERE timeblockID =  $timeblockID";

                         $result = mysqli_query($connections, $sql);

                    if ($result) {
                            echo "<script>alert('Timeblock Removed'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        } else {
                            $error = addslashes(mysqli_error($connections));
                            echo "<script>alert('Timeblock Error: $error'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        }
             }

             public function fetchtimeblock(){
                global $connections;

                $sql = "SELECT * FROM timeblocks";
                $result = mysqli_query($connections, $sql);

                 $gettimeblock = [];

                  if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                  $gettimeblock [] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

             return $gettimeblock;
             }


  public function fetchTimeblocksByPeriod() {
    global $connections;

    $sql = "SELECT *, 
                   CASE 
                       WHEN HOUR(startTime) < 12 THEN 'AM' 
                       ELSE 'PM' 
                   END AS period
            FROM timeblocks";
    
    $result = mysqli_query($connections, $sql);
    $timeblocks = ['AM' => [], 'PM' => []];

    if($result){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                // Group by AM/PM
                if($row['period'] === 'AM'){
                    $timeblocks['AM'][] = $row;
                } else {
                    $timeblocks['PM'][] = $row;
                }
            }
        }
    }

    return $timeblocks; // ['AM' => [...], 'PM' => [...]]
}
}