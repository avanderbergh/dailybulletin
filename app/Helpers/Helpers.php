<?php

class Helper{
    public static function canPost(){
        $posting_roles=['266717','285178','266719','270309','282984','267737','305579'];
        return in_array(session('schoology')['role_id'],$posting_roles);
    }
}