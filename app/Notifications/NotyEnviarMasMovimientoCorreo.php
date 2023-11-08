<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use PDF;
class NotyEnviarMasMovimientoCorreo extends Notification
{
    use Queueable;

    protected $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data=$data;
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
        $data = $this->data;

        $headerHtml = view()->make('pdf.header',['title'=>$data['title']])->render();
        $footerHtml = view()->make('pdf.footer')->render();
       $pdf = PDF::loadView('mis-cuentas.enviarMasMovimientoCorreoPdf', $data)
        ->setOption('margin-top', '2.5cm')
        ->setOption('margin-bottom', '1cm')
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        $pdf_data = $pdf->output();

        return (new MailMessage)
        ->subject($data['title'])
        ->line('Hemos atendido tu solicitud y generado un detallado de los movimientos de tu cuenta en Credimundo. Te invitamos a revisar el documento PDF adjunto, que contiene un desglose completo de todas las transacciones realizadas dentro de las fechas que especificaste. Por favor, dedica un momento para examinar minuciosamente esta información a tu conveniencia.')
        ->line('')
        ->line('Gracias por usar nuestra aplicación!')
        
        ->attachData($pdf_data,$data['title'].'.pdf');

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
