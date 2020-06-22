@if(@Auth::user()->hasRole('consumidor'))
<v-btn icon>
    <v-icon>mdi-bell</v-icon>
</v-btn>
@elseif(@Auth::user()->hasRole('comerciante'))
<notificaciones-comerciante id_user="{{auth()->user()->id}}"></notificaciones-comerciante>
@elseif(@Auth::user()->hasRole('administrador'))
<v-btn icon>
    <v-icon>mdi-bell</v-icon>
</v-btn>
@endif
