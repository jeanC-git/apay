@if(@Auth::user()->hasRole('consumidor'))
<v-list-item href="#">
    <v-list-item-icon>
        <v-icon>mdi-inbox</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Inbox</v-list-item-title>
    </v-list-item-content>
</v-list-item>
<v-list-item href="#">
    <v-list-item-icon>
        <v-icon>mdi-star</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Star</v-list-item-title>
    </v-list-item-content>
</v-list-item>


@elseif(@Auth::user()->hasRole('comerciante'))
<h2>Eres un comerciante</h2>


@elseif(@Auth::user()->hasRole('administrador'))

<h2>Eres un administrador</h2>
@endif
