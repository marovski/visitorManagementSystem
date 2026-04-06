@extends('main')

@section('title', '| Sobre')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="jumbotron" style="text-align: center;">
            <h2>{{ config('app.name') }}</h2>
            <p class="lead">A solução SaaS de gestão de visitantes desenvolvida para o mercado de Cabo Verde.</p>
        </div>

        <div class="about">

            <h3>O que é o {{ config('app.name') }}?</h3>
            <p>O <strong>{{ config('app.name') }}</strong> é uma plataforma multi-inquilino baseada na nuvem para gestão de visitantes, desenvolvida especificamente para empresas e organizações em Cabo Verde. Permite controlar entradas e saídas de visitantes, gerir reuniões, registar entregas e muito mais, de forma simples e segura.</p>

            <hr>

            <h3>Funcionalidades Principais</h3>
            <ul>
                <li><strong>Gestão de Visitantes Externos</strong> — Registo de visitas com geração de crachás e códigos QR.</li>
                <li><strong>Reuniões</strong> — Agendamento e acompanhamento de reuniões com notificações automáticas por email.</li>
                <li><strong>Entregas</strong> — Controlo de entregas de fornecedores com registo de motorista e viatura.</li>
                <li><strong>Objetos Perdidos e Achados</strong> — Registo e gestão de objetos perdidos nas instalações.</li>
                <li><strong>Painel de Administração</strong> — Gestão de utilizadores, planos e faturação por organização.</li>
                <li><strong>Multi-Inquilino</strong> — Cada organização tem os seus dados isolados e seguros.</li>
                <li><strong>Self Check-In</strong> — Visitantes podem efetuar o seu próprio registo de entrada.</li>
            </ul>

            <hr>

            <h3>Desenvolvido para Cabo Verde</h3>
            <p>A plataforma foi concebida tendo em conta as necessidades específicas do mercado cabo-verdiano, incluindo suporte ao fuso horário local (UTC-1) e uma interface simples e acessível para todo o tipo de organizações — desde pequenas empresas a grandes corporações.</p>

            <hr>

            <h3>Planos e Faturação</h3>
            <p>Oferecemos planos flexíveis adaptados à dimensão da sua organização. Comece com um período de teste gratuito de 14 dias e escolha o plano que melhor se adapta às suas necessidades.</p>

            <hr>

            <p class="text-muted text-center">&copy; {{ date('Y') }} {{ config('app.name') }} — Todos os direitos reservados.</p>

        </div>
    </div>
</div>

@endsection
