<?php
use Carbon\Carbon;

class UsuarioHelper
{
    public static function ultimoAcesso($dateTime)
    {
        Carbon::setLocale('pt_BR');
        
        if ($dateTime === null) {
            return 'Nunca acessou';
        }
        
        $ultimoAcesso = Carbon::parse($dateTime);
        $ultimoAcesso = $ultimoAcesso->diffForHumans();

        return $ultimoAcesso;
    }

}
