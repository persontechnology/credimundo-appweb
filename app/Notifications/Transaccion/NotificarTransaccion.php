<?php

namespace App\Notifications\Transaccion;

use App\Models\Transaccion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NotificarTransaccion extends Notification
{
    use Queueable;
    protected Transaccion $transaccion;
    /**
     * Create a new notification instance.
     */
    public function __construct($transaccion)
    {
        $this->transaccion=$transaccion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $tran=$this->transaccion;

        return (new MailMessage)
                    ->subject($tran->tipoTransaccion->nombre)
                    ->greeting('HOLA, '.$tran->cuentaUser->user->apellidos_nombres)
                    ->line('SE REALIZO UN '.$tran->tipoTransaccion->nombre.' DE: '.$tran->tipoTransaccion->tipo_signo.' $'.number_format($tran->valor,2))
                    ->line('CUENTA: '.$tran->cuentaUser->tipoCuenta->nombre)
                    ->line('N°. '.$tran->cuentaUser->numero_cuenta)
                    ->line(new HtmlString('<small>FECHA: '.$tran->created_at.'</small>'));
                    
                    
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
