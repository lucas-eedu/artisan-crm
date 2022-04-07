@component('mail::message')
   <h1>🎯 Dados do Lead</h1>
   <p>Lembre-se: Leads atendidos nos primeiros <b>5 minutos<b> têm maiores chances de <b>conversão!<b></p>
   <p><b>Nome: </b> {{$lead->name}}</p>
   <p><b>E-mail: </b> {{$lead->email}}</p>
   <p><b>Telefone: </b> {{$lead->phone}}</p>
   <p><b>Produto: </b> {{$lead->product->name}}</p>
   <p><b>Origem: </b> {{$lead->origin->name}}</p>
   <p><b>Mensagem: </b> {{$lead->message}}</p>
   <hr>
   <p><b>🚨 Atenção:</b> Não responda este e-mail. Mensagem enviada automaticamente pelo sistema.</p>
@endcomponent