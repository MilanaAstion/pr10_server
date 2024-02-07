<?php
class UspishnistModel extends Model
{
    public function getItems()
    {
        $q = "SELECT * FROM uspishnist";
        return $this->db_select_array($q);
    }
    
    public function getStudents()
    {
        $q = "SELECT * FROM students";
        return $this->db_select_array($q);
    }
    
    public function getSubjects()
    {
        $q = "SELECT * FROM subjects";
        return $this->db_select_array($q);
    }

    public function add()
    {
        $q = $this->insert_db_query($_POST, 'uspishnist');
        $this->db_query($q);
    }

    public function delete()
    {
        $q = "DELETE FROM uspishnist WHERE id = ".$_POST['delete'];
        $this->db_query($q);
    }

    public function update()
    {
        $q = "UPDATE uspishnist SET sid='".$_POST['sid']."', pid='".$_POST['pid']."', mark='".$_POST['mark']."' WHERE id = ".$_POST['update'];
        $this->db_query($q);
    }
}
?>