 
<?php
class ReservationA
{
    private $id_reservation = null;
    private $id_acc = null;
    private $id_user = null;
    private $date_Start = null;
    private $date_End = null;
    private $date_creation = null;
    private $payment_status = null;

    function __construct($id_acc, $id_user, $date_Start, $date_End, $date_creation, $payment_status)
    {
        $this->id_acc = $id_acc;
        $this->id_user = $id_user;
        $this->date_Start = $date_Start;
        $this->date_End = $date_End;
        $this->date_creation = $date_creation;
        $this->payment_status = $payment_status;
    }

    function getIdReservation()
    {
        return $this->id_reservation;
    }

    function getidAcc()
    {
        return $this->id_acc;
    }

    function setidAcc(int $id_acc)
    {
        $this->id_acc = $id_acc;
    }

    function getid_user()
    {
        return $this->id_user;
    }

    function setid_user(int $id_user)
    {
        $this->id_user = $id_user;
    }

    function getdate_Start()
    {
        return $this->date_Start;
    }

    function setdate_Start(string $date_Start)
    {
        $this->date_Start = $date_Start;
    }

    function getdate_End()
    {
        return $this->date_End;
    }

    function setdate_End(string $date_End)
    {
        $this->date_End = $date_End;
    }

    function getdate_creation()
    {
        return $this->date_creation;
    }

    function setdate_creation(string $date_creation)
    {
        $this->date_creation = $date_creation;
    }

    function getpayment_status()
    {
        return $this->payment_status;
    }

    function setpayment_status(string $payment_status)
    {
        $this->payment_status = $payment_status;
    }


//check payment status
function checkPaymentStatus(string $payment_status)
{
    if ($payment_status == "paid") {
        return 1;
    } else if ($payment_status == "Unpaid") {
        return 0;
    } else {
        return 2;
    }
}
}
?>