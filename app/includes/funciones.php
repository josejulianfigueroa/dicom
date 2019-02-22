  <?php
  function formatear_moneda($valor)
  {
     if ($valor == null or $valor == '')
    {
    return "$ 0";
    }
    else
    {
    return "$ " . number_format($valor, 0, ",", ".");
    }
  }
    function formatear_fecha($valor)
  {
    if ($valor == null)
    {
    return "-";
    }
    else
    {
    return date("d-m-Y",strtotime($valor));
    }
  }
     function formatear_fecha_completa($valor)
  {
    if ($valor == null)
    {
    return "-";
    }
    else
    {
    return date("d-m-Y h:i:s",strtotime($valor));
    }
  }
    function formatear_rut($valor)
  {
     if ($valor == null)
    {
    return "0";
    }
    else
    {
    return number_format($valor, 0, ",", ".");
    }
  }
  ?>