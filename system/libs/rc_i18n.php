<?php
defined('MYAAC') or die('Direct access not allowed!');

function rc_i18n_translations(): array
{
    static $translations = null;
    if ($translations !== null) {
        return $translations;
    }

    $translations = [
        ['pt-br' => 'Últimas Notícias', 'en' => 'Latest News', 'es' => 'Últimas noticias'],
        ['pt-br' => 'Notícias', 'en' => 'News', 'es' => 'Noticias'],
        ['pt-br' => 'Arquivo de Notícias', 'en' => 'News Archive', 'es' => 'Archivo de noticias'],
        ['pt-br' => 'Conta', 'en' => 'Account', 'es' => 'Cuenta'],
        ['pt-br' => 'Minha Conta', 'en' => 'My Account', 'es' => 'Mi cuenta'],
        ['pt-br' => 'Criar Conta', 'en' => 'Create Account', 'es' => 'Crear cuenta'],
        ['pt-br' => 'Registrar Conta', 'en' => 'Register Account', 'es' => 'Registrar cuenta'],
        ['pt-br' => 'Gerenciar Conta', 'en' => 'Account Management', 'es' => 'Gestionar cuenta'],
        ['pt-br' => 'Login da Conta', 'en' => 'Account Login', 'es' => 'Acceso a la cuenta'],
        ['pt-br' => 'Informações da Conta', 'en' => 'Account Information', 'es' => 'Información de la cuenta'],
        ['pt-br' => 'Nome da Conta', 'en' => 'Account Name', 'es' => 'Nombre de cuenta'],
        ['pt-br' => 'Número da Conta', 'en' => 'Account Number', 'es' => 'Número de cuenta'],
        ['pt-br' => 'Status da Conta', 'en' => 'Account Status', 'es' => 'Estado de la cuenta'],
        ['pt-br' => 'Último Login', 'en' => 'Last Login', 'es' => 'Último acceso'],
        ['pt-br' => 'Conta Free', 'en' => 'Free Account', 'es' => 'Cuenta gratis'],
        ['pt-br' => 'Conta Premium', 'en' => 'Premium Account', 'es' => 'Cuenta premium'],
        ['pt-br' => 'Entrar', 'en' => 'Login', 'es' => 'Entrar'],
        ['pt-br' => 'Sair', 'en' => 'Logout', 'es' => 'Salir'],
        ['pt-br' => 'Senha', 'en' => 'Password', 'es' => 'Contraseña'],
        ['pt-br' => 'E-mail', 'en' => 'Email Address', 'es' => 'Correo electrónico'],
        ['pt-br' => 'Perdeu a conta?', 'en' => 'Lost Account?', 'es' => '¿Perdiste tu cuenta?'],
        ['pt-br' => 'Alterar Senha', 'en' => 'Change Password', 'es' => 'Cambiar contraseña'],
        ['pt-br' => 'Alterar E-mail', 'en' => 'Change Email', 'es' => 'Cambiar correo'],
        ['pt-br' => 'Criar Personagem', 'en' => 'Create Character', 'es' => 'Crear personaje'],
        ['pt-br' => 'Nome do Personagem', 'en' => 'Character Name', 'es' => 'Nombre del personaje'],
        ['pt-br' => 'Personagens', 'en' => 'Characters', 'es' => 'Personajes'],
        ['pt-br' => 'Personagem', 'en' => 'Character', 'es' => 'Personaje'],
        ['pt-br' => 'Buscar Personagem', 'en' => 'Search Character', 'es' => 'Buscar personaje'],
        ['pt-br' => 'Nome do personagem', 'en' => 'Character name', 'es' => 'Nombre del personaje'],
        ['pt-br' => 'Use apenas letras e espaços', 'en' => 'Use only letters and spaces', 'es' => 'Usa solo letras y espacios'],
        ['pt-br' => 'Biblioteca', 'en' => 'Library', 'es' => 'Biblioteca'],
        ['pt-br' => 'Sistemas', 'en' => 'System', 'es' => 'Sistemas'],
        ['pt-br' => 'Sistemas', 'en' => 'Systems', 'es' => 'Sistemas'],
        ['pt-br' => 'Bazaar de Personagens', 'en' => 'Char Baazar', 'es' => 'Bazar de personajes'],
        ['pt-br' => 'Bazaar de Personagens', 'en' => 'Character Bazaar', 'es' => 'Bazar de personajes'],
        ['pt-br' => 'Doações', 'en' => 'Donate', 'es' => 'Donaciones'],
        ['pt-br' => 'Doe Aqui', 'en' => 'Donate Here', 'es' => 'Dona aquí'],
        ['pt-br' => 'Doar Agora', 'en' => 'Donate Now', 'es' => 'Donar ahora'],
        ['pt-br' => 'Moedas', 'en' => 'Coins', 'es' => 'Monedas'],
        ['pt-br' => 'Pagamento', 'en' => 'Payment', 'es' => 'Pago'],
        ['pt-br' => 'Comunidade', 'en' => 'Community', 'es' => 'Comunidad'],
        ['pt-br' => 'Idiomas', 'en' => 'Languages', 'es' => 'Idiomas'],
        ['pt-br' => 'Downloads', 'en' => 'Downloads', 'es' => 'Descargas'],
        ['pt-br' => 'Mapa Customizado', 'en' => 'Custom Map', 'es' => 'Mapa personalizado'],
        ['pt-br' => 'Domine, Conquiste, Seja Lendário', 'en' => 'Dominate, Conquer, Become Legendary', 'es' => 'Domina, conquista, conviértete en leyenda'],
        ['pt-br' => 'Status do Servidor', 'en' => 'Server Status', 'es' => 'Estado del servidor'],
        ['pt-br' => 'Informações do Servidor', 'en' => 'Server Info', 'es' => 'Información del servidor'],
        ['pt-br' => 'Estado', 'en' => 'State', 'es' => 'Estado'],
        ['pt-br' => 'Online', 'en' => 'Online', 'es' => 'Online'],
        ['pt-br' => 'Offline', 'en' => 'Offline', 'es' => 'Offline'],
        ['pt-br' => 'Jogadores Online', 'en' => 'Players Online', 'es' => 'Jugadores online'],
        ['pt-br' => 'Jogadores', 'en' => 'Players', 'es' => 'Jugadores'],
        ['pt-br' => 'Recorde Online', 'en' => 'Record Online', 'es' => 'Récord online'],
        ['pt-br' => 'Links Rápidos', 'en' => 'Quick Links', 'es' => 'Enlaces rápidos'],
        ['pt-br' => 'Highscores', 'en' => 'Highscores', 'es' => 'Clasificaciones'],
        ['pt-br' => 'Guildas', 'en' => 'Guilds', 'es' => 'Guilds'],
        ['pt-br' => 'Guilda', 'en' => 'Guild', 'es' => 'Guild'],
        ['pt-br' => 'Casas', 'en' => 'Houses', 'es' => 'Casas'],
        ['pt-br' => 'Casa', 'en' => 'House', 'es' => 'Casa'],
        ['pt-br' => 'Magias', 'en' => 'Spells', 'es' => 'Hechizos'],
        ['pt-br' => 'Magia', 'en' => 'Spell', 'es' => 'Hechizo'],
        ['pt-br' => 'Comandos', 'en' => 'Commands', 'es' => 'Comandos'],
        ['pt-br' => 'Regras', 'en' => 'Rules', 'es' => 'Reglas'],
        ['pt-br' => 'Equipe', 'en' => 'Team', 'es' => 'Equipo'],
        ['pt-br' => 'Fórum', 'en' => 'Forum', 'es' => 'Foro'],
        ['pt-br' => 'Top Jogadores', 'en' => 'Top Players', 'es' => 'Top jugadores'],
        ['pt-br' => 'Ranking Completo', 'en' => 'Full Ranking', 'es' => 'Ranking completo'],
        ['pt-br' => 'Buscar', 'en' => 'Search', 'es' => 'Buscar'],
        ['pt-br' => 'Ver', 'en' => 'View', 'es' => 'Ver'],
        ['pt-br' => 'Nível', 'en' => 'Level', 'es' => 'Nivel'],
        ['pt-br' => 'Nome', 'en' => 'Name', 'es' => 'Nombre'],
        ['pt-br' => 'Vocação', 'en' => 'Vocation', 'es' => 'Vocación'],
        ['pt-br' => 'Mundo', 'en' => 'World', 'es' => 'Mundo'],
        ['pt-br' => 'Rank', 'en' => 'Rank', 'es' => 'Rango'],
        ['pt-br' => 'Pontos', 'en' => 'Points', 'es' => 'Puntos'],
        ['pt-br' => 'Sexo', 'en' => 'Sex', 'es' => 'Sexo'],
        ['pt-br' => 'Masculino', 'en' => 'Male', 'es' => 'Masculino'],
        ['pt-br' => 'Feminino', 'en' => 'Female', 'es' => 'Femenino'],
        ['pt-br' => 'Enviar', 'en' => 'Submit', 'es' => 'Enviar'],
        ['pt-br' => 'Voltar', 'en' => 'Back', 'es' => 'Volver'],
        ['pt-br' => 'Cancelar', 'en' => 'Cancel', 'es' => 'Cancelar'],
        ['pt-br' => 'Editar', 'en' => 'Edit', 'es' => 'Editar'],
        ['pt-br' => 'Excluir', 'en' => 'Delete', 'es' => 'Eliminar'],
        ['pt-br' => 'Salvar', 'en' => 'Save', 'es' => 'Guardar'],
        ['pt-br' => 'Confirmar', 'en' => 'Confirm', 'es' => 'Confirmar'],
        ['pt-br' => 'Criar', 'en' => 'Create', 'es' => 'Crear'],
        ['pt-br' => 'Atualizar', 'en' => 'Update', 'es' => 'Actualizar'],
        ['pt-br' => 'Próximo', 'en' => 'Next', 'es' => 'Siguiente'],
        ['pt-br' => 'Anterior', 'en' => 'Previous', 'es' => 'Anterior'],
        ['pt-br' => 'Erro', 'en' => 'Error', 'es' => 'Error'],
        ['pt-br' => 'Sucesso', 'en' => 'Success', 'es' => 'Éxito'],
        ['pt-br' => 'Aviso', 'en' => 'Warning', 'es' => 'Aviso'],
        ['pt-br' => 'Últimas Mortes', 'en' => 'Last Kills', 'es' => 'Últimas muertes'],
        ['pt-br' => 'Experiência', 'en' => 'Experience', 'es' => 'Experiencia'],
        ['pt-br' => 'Tabela de Experiência', 'en' => 'Experience Table', 'es' => 'Tabla de experiencia'],
        ['pt-br' => 'Galeria', 'en' => 'Gallery', 'es' => 'Galería'],
        ['pt-br' => 'FAQ', 'en' => 'FAQ', 'es' => 'FAQ'],
        ['pt-br' => 'Atendimento', 'en' => 'Tickets', 'es' => 'Soporte'],
        ['pt-br' => 'Assunto', 'en' => 'Subject', 'es' => 'Asunto'],
        ['pt-br' => 'Mensagem', 'en' => 'Message', 'es' => 'Mensaje'],
        ['pt-br' => 'Todos os direitos reservados.', 'en' => 'All rights reserved.', 'es' => 'Todos los derechos reservados.'],
        ['pt-br' => 'Ações da Staff', 'en' => 'Staff Actions', 'es' => 'Acciones del staff'],
        ['pt-br' => 'Drops Importantes', 'en' => 'Drops Important', 'es' => 'Drops importantes'],
        ['pt-br' => 'Buscador de Boss', 'en' => 'Boss Finder', 'es' => 'Buscador de bosses'],
        ['pt-br' => 'Buscador de Hunts', 'en' => 'Hunt Finder', 'es' => 'Buscador de hunts'],
        ['pt-br' => 'Sistema de Tier', 'en' => 'Tier System', 'es' => 'Sistema de tier'],
        ['pt-br' => 'Sistema de Upgrade', 'en' => 'Upgrade System', 'es' => 'Sistema de mejora'],
        ['pt-br' => 'Sistema de Skill Gem', 'en' => 'Skill Gem System', 'es' => 'Sistema de skill gem'],
        ['pt-br' => 'Supreme Tasks', 'en' => 'Supreme Tasks', 'es' => 'Supreme Tasks'],
        ['pt-br' => 'Bônus de Addon e Mount', 'en' => 'Addon&Mount Bonuses', 'es' => 'Bonos de addon y mount'],
        ['pt-br' => 'Bônus das Pedras Elementais', 'en' => "Elemental's Stones Bonuses", 'es' => 'Bonos de piedras elementales'],
        ['pt-br' => 'Bazaar Atual', 'en' => 'Current Bazaar', 'es' => 'Bazar actual'],
        ['pt-br' => 'Criar Leilão', 'en' => 'Create Auction', 'es' => 'Crear subasta'],
        ['pt-br' => 'Meus Trades', 'en' => 'Own Trades', 'es' => 'Mis trades'],
        ['pt-br' => 'Meus Lances', 'en' => 'Own Bids', 'es' => 'Mis ofertas'],
        ['pt-br' => 'Trades Antigos', 'en' => 'Past Trades', 'es' => 'Trades anteriores'],
        ['pt-br' => 'Entrar na comunidade RavynCore no Discord.', 'en' => 'Join the RavynCore Discord community.', 'es' => 'Únete a la comunidad de RavynCore en Discord.'],
        ['pt-br' => 'Entrar no grupo oficial do RavynCore no WhatsApp.', 'en' => 'Join the official RavynCore WhatsApp group.', 'es' => 'Únete al grupo oficial de RavynCore en WhatsApp.'],
        ['pt-br' => 'Seguir RavynCore no Instagram.', 'en' => 'Follow RavynCore on Instagram.', 'es' => 'Sigue a RavynCore en Instagram.'],
        ['pt-br' => 'Assistir vídeos do RavynCore no TikTok.', 'en' => 'Watch RavynCore videos on TikTok.', 'es' => 'Mira videos de RavynCore en TikTok.'],
        ['pt-br' => 'Seguir atualizações do RavynCore no Facebook.', 'en' => 'Follow RavynCore updates on Facebook.', 'es' => 'Sigue las novedades de RavynCore en Facebook.'],
        ['pt-br' => 'Informações do Personagem', 'en' => 'Character Information', 'es' => 'Información del personaje'],
        ['pt-br' => 'Lista de Personagens', 'en' => 'Character List', 'es' => 'Lista de personajes'],
        ['pt-br' => 'Criar Novo Personagem', 'en' => 'Create New Character', 'es' => 'Crear nuevo personaje'],
        ['pt-br' => 'Personagem Principal', 'en' => 'Main Character', 'es' => 'Personaje principal'],
        ['pt-br' => 'Membro da Guilda', 'en' => 'Guild Membership', 'es' => 'Membresía de guild'],
        ['pt-br' => 'Editar Personagem', 'en' => 'Edit Character', 'es' => 'Editar personaje'],
        ['pt-br' => 'Excluir Personagem', 'en' => 'Delete Character', 'es' => 'Eliminar personaje'],
        ['pt-br' => 'Alterar Nome', 'en' => 'Change Name', 'es' => 'Cambiar nombre'],
        ['pt-br' => 'Alterar Sexo', 'en' => 'Change Sex', 'es' => 'Cambiar sexo'],
        ['pt-br' => 'Editar Informações do Personagem', 'en' => 'Edit Character Information', 'es' => 'Editar información del personaje'],
        ['pt-br' => 'Ocultar Conta', 'en' => 'Hide Account', 'es' => 'Ocultar cuenta'],
        ['pt-br' => 'Pontos de Loyalt', 'en' => 'Loyalt Points', 'es' => 'Puntos de loyalt'],
        ['pt-br' => 'Pontos de Loyalty', 'en' => 'Loyalty Points', 'es' => 'Puntos de loyalty'],
        ['pt-br' => 'Título de Loyalt', 'en' => 'Loyalt Title', 'es' => 'Título de loyalt'],
        ['pt-br' => 'Pontos de Charm', 'en' => 'Charm Points', 'es' => 'Puntos de charm'],
        ['pt-br' => 'Addons Completos', 'en' => 'Full Addons', 'es' => 'Addons completos'],
        ['pt-br' => 'Mounts Completas', 'en' => 'Full Mounts', 'es' => 'Mounts completas'],
        ['pt-br' => 'Residência', 'en' => 'Residence', 'es' => 'Residencia'],
        ['pt-br' => 'Saldo', 'en' => 'Balance', 'es' => 'Saldo'],
        ['pt-br' => 'Gold Coins', 'en' => 'Gold Coins', 'es' => 'Gold Coins'],
        ['pt-br' => 'Tibia Coins', 'en' => 'Tibia Coins', 'es' => 'Tibia Coins'],
        ['pt-br' => 'Tournament Coins', 'en' => 'Tournament Coins', 'es' => 'Tournament Coins'],
        ['pt-br' => 'Criado em', 'en' => 'Created', 'es' => 'Creado'],
        ['pt-br' => 'Registrado', 'en' => 'Registered', 'es' => 'Registrado'],
        ['pt-br' => 'Nome Real', 'en' => 'Real Name', 'es' => 'Nombre real'],
        ['pt-br' => 'Editar Informações de Contato', 'en' => 'Edit Contact Info', 'es' => 'Editar información de contacto'],
        ['pt-br' => 'Logs da Conta', 'en' => 'Account logs', 'es' => 'Registros de la cuenta'],
        ['pt-br' => 'Adicionar Ticket', 'en' => 'Add Ticket', 'es' => 'Agregar ticket'],
        ['pt-br' => 'Mostrar Todos', 'en' => 'Show All', 'es' => 'Mostrar todos'],
        ['pt-br' => 'Comprar Coins', 'en' => 'Get Coins', 'es' => 'Comprar coins'],
        ['pt-br' => 'Buscar House', 'en' => 'House Search', 'es' => 'Buscar house'],
        ['pt-br' => 'Disponível', 'en' => 'Available', 'es' => 'Disponible'],
        ['pt-br' => 'Alugada', 'en' => 'Rented', 'es' => 'Alquilada'],
        ['pt-br' => 'Livre', 'en' => 'Free', 'es' => 'Libre'],
        ['pt-br' => 'Tamanho', 'en' => 'Size', 'es' => 'Tamaño'],
        ['pt-br' => 'Aluguel', 'en' => 'Rent', 'es' => 'Alquiler'],
        ['pt-br' => 'Cidade', 'en' => 'City', 'es' => 'Ciudad'],
        ['pt-br' => 'Proprietário', 'en' => 'Owner', 'es' => 'Propietario'],
        ['pt-br' => 'Informações da Guilda', 'en' => 'Guild Information', 'es' => 'Información de la guild'],
        ['pt-br' => 'Guildas Ativas', 'en' => 'Active Guilds', 'es' => 'Guilds activas'],
        ['pt-br' => 'Criar Guilda', 'en' => 'Create Guild', 'es' => 'Crear guild'],
        ['pt-br' => 'Fundar Guilda', 'en' => 'Found Guild', 'es' => 'Fundar guild'],
        ['pt-br' => 'Editar Ranks', 'en' => 'Edit Ranks', 'es' => 'Editar rangos'],
        ['pt-br' => 'Alterar Banner', 'en' => 'Change Banner', 'es' => 'Cambiar banner'],
        ['pt-br' => 'Saldo do Banco da Guilda', 'en' => 'Guild Bank Account Balance', 'es' => 'Saldo del banco de la guild'],
        ['pt-br' => 'Recorde Online', 'en' => 'Online Record', 'es' => 'Récord online'],
        ['pt-br' => 'Status das Vocações', 'en' => 'Vocations Status', 'es' => 'Estado de vocaciones'],
        ['pt-br' => 'Players Online', 'en' => 'Players Online', 'es' => 'Jugadores online'],
        ['pt-br' => 'Server Save', 'en' => 'Server Save', 'es' => 'Server save'],
        ['pt-br' => 'Buscar Char', 'en' => 'Search Char', 'es' => 'Buscar char'],
        ['pt-br' => 'Trocar Tibia Coins!', 'en' => 'Trade Tibia Coins!', 'es' => '¡Intercambia Tibia Coins!'],
        ['pt-br' => 'Comprar Decoração Épica!', 'en' => 'Buy Epic Decoration!', 'es' => '¡Compra decoración épica!'],
        ['pt-br' => 'Virar Premium!', 'en' => 'Become Premium!', 'es' => '¡Hazte premium!'],
        ['pt-br' => 'Usar Boosts de XP!', 'en' => 'Use XP Boosts!', 'es' => '¡Usa boosts de XP!'],
        ['pt-br' => 'Pegar Supplies em Qualquer Lugar!', 'en' => 'Get Supplies Anywhere!', 'es' => '¡Obtén supplies en cualquier lugar!'],
        ['pt-br' => 'Treinar Skills Offline!', 'en' => 'Train Skills Offline!', 'es' => '¡Entrena skills offline!'],
        ['pt-br' => 'Acessar TODAS as Áreas!', 'en' => 'Access ALL Areas!', 'es' => '¡Accede a TODAS las áreas!'],
        ['pt-br' => 'Comprar Tibia Coins', 'en' => 'Get Tibia Coins', 'es' => 'Comprar Tibia Coins'],
        ['pt-br' => 'Escolha', 'en' => 'Choose', 'es' => 'Elegir'],
        ['pt-br' => 'Descrição', 'en' => 'Description', 'es' => 'Descripción'],
        ['pt-br' => 'Preço', 'en' => 'Price', 'es' => 'Precio'],
        ['pt-br' => 'Data', 'en' => 'Date', 'es' => 'Fecha'],
        ['pt-br' => 'Tipo', 'en' => 'Type', 'es' => 'Tipo'],
        ['pt-br' => 'Ação', 'en' => 'Action', 'es' => 'Acción'],
        ['pt-br' => 'Título', 'en' => 'Title', 'es' => 'Título'],
        ['pt-br' => 'Aberto', 'en' => 'Open', 'es' => 'Abierto'],
        ['pt-br' => 'Fechado', 'en' => 'Closed', 'es' => 'Cerrado'],
        ['pt-br' => 'Pendente', 'en' => 'Pending', 'es' => 'Pendiente'],
    ];

    $translations = array_merge($translations, rc_i18n_page_translations());

    return $translations;
}

function rc_i18n_page_translations(): array
{
    return [
        ['pt-br' => 'Changelog', 'en' => 'Changelog', 'es' => 'Registro de cambios'],
        ['pt-br' => 'Regras do Servidor', 'en' => 'Server Rules', 'es' => 'Reglas del servidor'],
        ['pt-br' => 'Reportar Bug', 'en' => 'Report Bug', 'es' => 'Reportar bug'],
        ['pt-br' => 'Quem está online?', 'en' => 'Who Is Online?', 'es' => '¿Quién está online?'],
        ['pt-br' => 'Últimas Mortes', 'en' => 'Last Deaths', 'es' => 'Últimas muertes'],
        ['pt-br' => 'Enquetes', 'en' => 'Polls', 'es' => 'Encuestas'],
        ['pt-br' => 'Lista de Suporte', 'en' => 'Support List', 'es' => 'Lista de soporte'],
        ['pt-br' => 'Criaturas', 'en' => 'Creatures', 'es' => 'Criaturas'],
        ['pt-br' => 'Estágios de EXP', 'en' => 'Exp Stages', 'es' => 'Etapas de EXP'],
        ['pt-br' => 'Comprar Pontos', 'en' => 'Buy Points', 'es' => 'Comprar puntos'],
        ['pt-br' => 'Oferta da Loja', 'en' => 'Shop Offer', 'es' => 'Oferta de la tienda'],
        ['pt-br' => 'Histórico da Loja', 'en' => 'Shop History', 'es' => 'Historial de la tienda'],
        ['pt-br' => 'Caixas', 'en' => 'Boxes', 'es' => 'Cajas'],
        ['pt-br' => 'Criar Conta RavynCore', 'en' => 'Create RavynCore Account', 'es' => 'Crear cuenta RavynCore'],
        ['pt-br' => 'País', 'en' => 'Country', 'es' => 'País'],
        ['pt-br' => 'Repetir senha', 'en' => 'Repeat password', 'es' => 'Repetir contraseña'],
        ['pt-br' => 'Mostrar', 'en' => 'Show', 'es' => 'Mostrar'],
        ['pt-br' => 'Ocultar', 'en' => 'Hide', 'es' => 'Ocultar'],
        ['pt-br' => 'Selecionar cidade', 'en' => 'Select your town', 'es' => 'Seleccionar ciudad'],
        ['pt-br' => 'Por favor, selecione a caixa abaixo:', 'en' => 'Please select the following check box:', 'es' => 'Por favor, selecciona la siguiente casilla:'],
        ['pt-br' => 'Eu concordo com as', 'en' => 'I agree to the', 'es' => 'Acepto las'],
        ['pt-br' => 'Por favor, use um endereço real! Enviaremos um link para validar seu e-mail.', 'en' => 'Please use real address! We will send a link to validate your Email.', 'es' => '¡Usa una dirección real! Enviaremos un enlace para validar tu e-mail.'],
        ['pt-br' => 'Para jogar no RavynCore você precisa de uma conta.', 'en' => 'To play on RavynCore you need an account.', 'es' => 'Para jugar en RavynCore necesitas una cuenta.'],
        ['pt-br' => 'Tudo que você precisa fazer para criar sua nova conta é informar nome da conta, senha, país e seu endereço de e-mail.', 'en' => 'All you have to do to create your new account is to enter an account name, password, country and your email address.', 'es' => 'Para crear tu nueva cuenta, informa el nombre de la cuenta, contraseña, país y tu e-mail.'],
        ['pt-br' => 'Você também precisa concordar com os termos apresentados abaixo.', 'en' => 'Also you have to agree to the terms presented below.', 'es' => 'También debes aceptar los términos presentados abajo.'],
        ['pt-br' => 'Se você fizer isso, o nome da sua conta será exibido na próxima página e a senha da sua conta será enviada para seu e-mail junto com mais instruções.', 'en' => 'If you have done so, your account name will be shown on the following page and your account password will be sent to your email address along with further instructions.', 'es' => 'Si lo haces, el nombre de tu cuenta se mostrará en la siguiente página y la contraseña será enviada a tu e-mail con más instrucciones.'],
        ['pt-br' => 'Se você não receber o e-mail com sua senha, verifique sua caixa de spam.', 'en' => 'If you do not receive the email with your password, please check your spam filter.', 'es' => 'Si no recibes el e-mail con tu contraseña, revisa tu carpeta de spam.'],
        ['pt-br' => 'A conta com este e-mail já existe.', 'en' => 'Account with this e-mail address already exist.', 'es' => 'Ya existe una cuenta con este e-mail.'],
        ['pt-br' => 'Informe a senha novamente!', 'en' => 'Please enter the password again!', 'es' => '¡Ingresa la contraseña nuevamente!'],
        ['pt-br' => 'Informe a senha da sua nova conta.', 'en' => 'Please enter the password for your new account.', 'es' => 'Ingresa la contraseña de tu nueva cuenta.'],
        ['pt-br' => 'As senhas não são iguais.', 'en' => 'Passwords are not the same.', 'es' => 'Las contraseñas no coinciden.'],
        ['pt-br' => 'Você precisa concordar com as Regras para criar uma conta!', 'en' => 'You have to agree to the RavynCore Rules in order to create an account!', 'es' => 'Debes aceptar las reglas de RavynCore para crear una cuenta.'],
        ['pt-br' => 'Interface de Recuperação de Conta', 'en' => 'Lost Account Interface', 'es' => 'Interfaz de recuperación de cuenta'],
        ['pt-br' => 'Bem-vindo à Interface de Recuperação de Conta!', 'en' => 'Welcome to the Lost Account Interface!', 'es' => '¡Bienvenido a la interfaz de recuperación de cuenta!'],
        ['pt-br' => 'Se você perdeu o acesso à sua conta, esta interface pode ajudar.', 'en' => 'If you have lost access to your account, this interface can help you.', 'es' => 'Si perdiste el acceso a tu cuenta, esta interfaz puede ayudarte.'],
        ['pt-br' => 'Você precisa provar que sua solicitação sobre a conta é legítima.', 'en' => 'Of course, you need to prove that your claim to the account is justified.', 'es' => 'Debes probar que tu solicitud sobre la cuenta es legítima.'],
        ['pt-br' => 'Informe os dados solicitados e siga as instruções com atenção.', 'en' => 'Enter the requested data and follow the instructions carefully.', 'es' => 'Ingresa los datos solicitados y sigue las instrucciones con atención.'],
        ['pt-br' => 'Entenda que não há como recuperar sua conta se a interface não conseguir ajudar.', 'en' => 'Please understand there is no way to get access to your lost account if the interface cannot help you.', 'es' => 'Ten en cuenta que no hay forma de recuperar tu cuenta si la interfaz no consigue ayudarte.'],
        ['pt-br' => 'Outras opções para alterar dados da conta ficam disponíveis se você tiver uma conta registrada.', 'en' => 'Further options to change account data are available if you have a registered account.', 'es' => 'Otras opciones para cambiar datos de la cuenta estarán disponibles si tienes una cuenta registrada.'],
        ['pt-br' => 'Usando a Interface de Recuperação de Conta você pode', 'en' => 'By using the Lost Account Interface you can', 'es' => 'Usando la interfaz de recuperación de cuenta puedes'],
        ['pt-br' => 'obter uma nova senha caso tenha perdido a senha atual,', 'en' => 'get a new password if you have lost the current password,', 'es' => 'obtener una nueva contraseña si perdiste la contraseña actual,'],
        ['pt-br' => 'recuperar sua conta caso ela tenha sido hackeada,', 'en' => 'get your account back if it has been hacked,', 'es' => 'recuperar tu cuenta si fue hackeada,'],
        ['pt-br' => 'alterar instantaneamente o e-mail da sua conta', 'en' => 'change the email address of your account instantly', 'es' => 'cambiar instantáneamente el e-mail de tu cuenta'],
        ['pt-br' => 'solicitar uma nova recovery key/recovery TAN', 'en' => 'request a new recovery key/recovery TAN', 'es' => 'solicitar una nueva recovery key/recovery TAN'],
        ['pt-br' => 'remover um aplicativo autenticador da sua conta', 'en' => 'remove an authenticator app from your account', 'es' => 'eliminar una app autenticadora de tu cuenta'],
        ['pt-br' => 'desativar autenticação por código de e-mail da sua conta', 'en' => 'disable email code authentication for your account', 'es' => 'desactivar la autenticación por código de e-mail de tu cuenta'],
        ['pt-br' => 'Como primeiro passo, informe o nome de um personagem ou o e-mail da sua conta e clique em "Enviar".', 'en' => 'As a first step to use the Lost Account Interface, please enter the name of a character or the email address of your account and click on "Submit".', 'es' => 'Como primer paso, ingresa el nombre de un personaje o el e-mail de tu cuenta y haz clic en "Enviar".'],
        ['pt-br' => 'Conta perdida', 'en' => 'Lost account', 'es' => 'Cuenta perdida'],
        ['pt-br' => 'Informe o nome do personagem', 'en' => 'Please enter your character name', 'es' => 'Ingresa el nombre de tu personaje'],
        ['pt-br' => 'Ou informe seu e-mail', 'en' => 'Or enter your e-mail', 'es' => 'O ingresa tu e-mail'],
        ['pt-br' => 'O que você deseja?', 'en' => 'What do you want?', 'es' => '¿Qué deseas hacer?'],
        ['pt-br' => 'Enviar nova senha e nome da conta para o e-mail da conta.', 'en' => 'Send me new password and my account name to account e-mail adress.', 'es' => 'Enviarme una nueva contraseña y el nombre de la cuenta al e-mail de la cuenta.'],
        ['pt-br' => 'Tenho uma recovery key e quero definir nova senha e novo e-mail para minha conta.', 'en' => 'I got recovery key and want set new password and e-mail adress to my account.', 'es' => 'Tengo una recovery key y quiero definir nueva contraseña y nuevo e-mail para mi cuenta.'],
        ['pt-br' => 'Não tenho personagem criado e quero recuperar minha conta.', 'en' => 'I don\'t have character created and want to recovery my account.', 'es' => 'No tengo un personaje creado y quiero recuperar mi cuenta.'],
        ['pt-br' => 'Drops Importantes', 'en' => 'Drops Important', 'es' => 'Drops importantes'],
        ['pt-br' => 'Obtenção', 'en' => 'Obtaining', 'es' => 'Obtención'],
        ['pt-br' => 'Fragmentos', 'en' => 'Fragments', 'es' => 'Fragmentos'],
        ['pt-br' => 'Modo de obtenção — Destruction Rarity', 'en' => 'How to obtain — Destruction Rarity', 'es' => 'Modo de obtención — Destruction Rarity'],
        ['pt-br' => 'Use em:', 'en' => 'Use on:', 'es' => 'Usa en:'],
        ['pt-br' => 'Alvo', 'en' => 'Target', 'es' => 'Objetivo'],
        ['pt-br' => 'Como obter', 'en' => 'How to obtain', 'es' => 'Cómo obtener'],
        ['pt-br' => 'Cada Bag of Stone contém pedras elementais.', 'en' => 'Each Bag of Stone contains elemental stones.', 'es' => 'Cada Bag of Stone contiene piedras elementales.'],
        ['pt-br' => 'O nível da bag define a dificuldade do drop ou o custo em RavynCore Token no Jorge Trambiqueiro.', 'en' => 'The bag level defines the drop difficulty or the RavynCore Token cost at Jorge Trambiqueiro.', 'es' => 'El nivel de la bag define la dificultad del drop o el costo en RavynCore Token con Jorge Trambiqueiro.'],
        ['pt-br' => 'Usados na conversão Stone Forge', 'en' => 'Used in Stone Forge conversion', 'es' => 'Usados en la conversión Stone Forge'],
        ['pt-br' => 'Buscador de Hunts', 'en' => 'Hunt Finder', 'es' => 'Buscador de hunts'],
        ['pt-br' => 'Como funciona', 'en' => 'How it works', 'es' => 'Cómo funciona'],
        ['pt-br' => 'Como Funciona?', 'en' => 'How does it work?', 'es' => '¿Cómo funciona?'],
        ['pt-br' => 'Funcionalidades', 'en' => 'Features', 'es' => 'Funcionalidades'],
        ['pt-br' => 'Dificuldades', 'en' => 'Difficulties', 'es' => 'Dificultades'],
        ['pt-br' => 'Instâncias', 'en' => 'Instances', 'es' => 'Instancias'],
        ['pt-br' => 'Teleport de retorno', 'en' => 'Return teleport', 'es' => 'Teleport de retorno'],
        ['pt-br' => 'Dificuldade', 'en' => 'Difficulty', 'es' => 'Dificultad'],
        ['pt-br' => 'Descrição', 'en' => 'Description', 'es' => 'Descripción'],
        ['pt-br' => 'Instância', 'en' => 'Instance', 'es' => 'Instancia'],
        ['pt-br' => 'sem PZ', 'en' => 'without PZ', 'es' => 'sin PZ'],
        ['pt-br' => 'Buscador de Boss', 'en' => 'Boss Finder', 'es' => 'Buscador de bosses'],
        ['pt-br' => 'Progressão', 'en' => 'Progression', 'es' => 'Progresión'],
        ['pt-br' => 'Resumo', 'en' => 'Summary', 'es' => 'Resumen'],
        ['pt-br' => 'Regras gerais', 'en' => 'General rules', 'es' => 'Reglas generales'],
        ['pt-br' => 'Progressão de Bosses', 'en' => 'Boss progression', 'es' => 'Progresión de bosses'],
        ['pt-br' => 'Bosses com Progressão', 'en' => 'Bosses with progression', 'es' => 'Bosses con progresión'],
        ['pt-br' => 'Resumo dos Sistemas', 'en' => 'System summary', 'es' => 'Resumen de sistemas'],
        ['pt-br' => 'Sistema', 'en' => 'System', 'es' => 'Sistema'],
        ['pt-br' => 'Boss Final', 'en' => 'Final Boss', 'es' => 'Boss final'],
        ['pt-br' => 'Reset após derrotar o final', 'en' => 'Reset after defeating the final boss', 'es' => 'Reset después de derrotar al boss final'],
        ['pt-br' => 'Sim', 'en' => 'Yes', 'es' => 'Sí'],
        ['pt-br' => 'Sobre', 'en' => 'About', 'es' => 'Sobre'],
        ['pt-br' => 'Extração', 'en' => 'Extraction', 'es' => 'Extracción'],
        ['pt-br' => 'Aplicação', 'en' => 'Application', 'es' => 'Aplicación'],
        ['pt-br' => 'Informações', 'en' => 'Information', 'es' => 'Información'],
        ['pt-br' => 'Informações Importantes', 'en' => 'Important information', 'es' => 'Información importante'],
        ['pt-br' => 'Itens do Sistema', 'en' => 'System items', 'es' => 'Ítems del sistema'],
        ['pt-br' => 'Tiers Disponíveis', 'en' => 'Available tiers', 'es' => 'Tiers disponibles'],
        ['pt-br' => 'Sobre o Sistema de Tier', 'en' => 'About the Tier System', 'es' => 'Sobre el sistema de tier'],
        ['pt-br' => 'Como Funciona a Extração?', 'en' => 'How does extraction work?', 'es' => '¿Cómo funciona la extracción?'],
        ['pt-br' => 'Como Funciona a Aplicação?', 'en' => 'How does application work?', 'es' => '¿Cómo funciona la aplicación?'],
        ['pt-br' => 'Como Fazer', 'en' => 'How to do it', 'es' => 'Cómo hacerlo'],
        ['pt-br' => 'Categorias', 'en' => 'Categories', 'es' => 'Categorías'],
        ['pt-br' => 'Categorias e Recompensas', 'en' => 'Categories and rewards', 'es' => 'Categorías y recompensas'],
        ['pt-br' => 'Como Fazer?', 'en' => 'How to do it?', 'es' => '¿Cómo hacerlo?'],
    ];
}

function rc_supported_languages(?string $templatePath = null): array
{
    $flagBase = ($templatePath ?: 'templates/tibiacom') . '/images/lang';
    return [
        'pt-br' => ['label' => 'Português/BR', 'short' => 'BR', 'html' => 'pt-BR', 'flag' => $flagBase . '/flag-br.svg'],
        'en' => ['label' => 'English', 'short' => 'EN', 'html' => 'en', 'flag' => $flagBase . '/flag-en.svg'],
        'es' => ['label' => 'Español', 'short' => 'ES', 'html' => 'es', 'flag' => $flagBase . '/flag-es.svg'],
    ];
}

function rc_i18n_normalize_language($language): string
{
    $language = strtolower(trim((string)$language));
    $aliases = [
        'pt' => 'pt-br',
        'pt_br' => 'pt-br',
        'pt-br' => 'pt-br',
        'br' => 'pt-br',
        'en' => 'en',
        'eng' => 'en',
        'en-us' => 'en',
        'en-gb' => 'en',
        'es' => 'es',
        'esp' => 'es',
        'es-es' => 'es',
    ];

    return $aliases[$language] ?? 'pt-br';
}

function rc_i18n_init(): void
{
    static $initialized = false;
    if ($initialized) {
        return;
    }

    $language = rc_i18n_normalize_language($_GET['lang'] ?? $_COOKIE['rc_lang'] ?? 'pt-br');
    $GLOBALS['rcCurrentLang'] = $language;

    if (!(defined('IS_CLI') && IS_CLI) && isset($_GET['lang']) && !headers_sent()) {
        setcookie('rc_lang', $language, time() + (86400 * 365), '/');
    }

    $initialized = true;
}

function rc_current_language(): string
{
    rc_i18n_init();
    return $GLOBALS['rcCurrentLang'] ?? 'pt-br';
}

function rc_html_language(): string
{
    $languages = rc_supported_languages();
    $current = rc_current_language();
    return $languages[$current]['html'] ?? 'pt-BR';
}

function rc_translation_key($text): string
{
    $key = preg_replace('/\s+/', ' ', trim((string)$text));
    return function_exists('mb_strtolower') ? mb_strtolower($key, 'UTF-8') : strtolower($key);
}

function rc_i18n_index(): array
{
    static $index = null;
    if ($index !== null) {
        return $index;
    }

    $index = [];
    foreach (rc_i18n_translations() as $translation) {
        foreach ($translation as $phrase) {
            $index[rc_translation_key($phrase)] = $translation;
        }
    }

    return $index;
}

function rc_t($text): string
{
    $text = (string)$text;
    $index = rc_i18n_index();
    $key = rc_translation_key($text);
    $language = rc_current_language();
    return $index[$key][$language] ?? $text;
}

function rc_i18n_replacements(): array
{
    static $cache = [];
    $language = rc_current_language();
    if (isset($cache[$language])) {
        return $cache[$language];
    }

    $replacements = [];
    foreach (rc_i18n_translations() as $translation) {
        $target = $translation[$language] ?? null;
        if ($target === null || $target === '') {
            continue;
        }

        foreach ($translation as $source) {
            $source = (string)$source;
            if ($source !== $target && strlen($source) > 1) {
                $replacements[$source] = $target;
            }
        }
    }

    uksort($replacements, static function($a, $b) {
        return strlen($b) <=> strlen($a);
    });

    $cache[$language] = $replacements;
    return $replacements;
}

function rc_i18n_source_pattern($source): string
{
    $source = trim((string)$source);
    if ($source === '') {
        return '//u';
    }

    $leftBoundary = preg_match('/^[\pL\pN]/u', $source) ? '(?<![\pL\pN_])' : '';
    $rightBoundary = preg_match('/[\pL\pN]$/u', $source) ? '(?![\pL\pN_])' : '';
    $parts = preg_split('/\s+/u', $source, -1, PREG_SPLIT_NO_EMPTY);
    $quoted = [];
    foreach ($parts as $part) {
        $quoted[] = preg_quote($part, '/');
    }

    return '/' . $leftBoundary . implode('\\s+', $quoted) . $rightBoundary . '/u';
}

function rc_translate_html($html): string
{
    $html = (string)$html;
    if ($html === '') {
        return $html;
    }

    $protected = [];
    $html = preg_replace_callback('/<(style|textarea|pre|code)\b[^>]*>.*?<\/\1>/is', static function($matches) use (&$protected) {
        $token = '%%RC_I18N_BLOCK_' . count($protected) . '%%';
        $protected[$token] = $matches[0];
        return $token;
    }, $html);

    foreach (rc_i18n_replacements() as $source => $target) {
        $pattern = rc_i18n_source_pattern($source);
        $translated = @preg_replace($pattern, (string)$target, $html);
        $html = $translated !== null ? $translated : str_replace($source, (string)$target, $html);
    }

    if (!empty($protected)) {
        $html = strtr($html, $protected);
    }

    return $html;
}

function rc_i18n_output_callback($html): string
{
    if ((defined('IS_CLI') && IS_CLI) || $html === '') {
        return (string)$html;
    }

    $contentType = '';
    foreach (headers_list() as $header) {
        if (stripos($header, 'Content-Type:') === 0) {
            $contentType = strtolower($header);
            break;
        }
    }

    if ($contentType !== '' && strpos($contentType, 'text/html') === false) {
        return (string)$html;
    }

    $html = (string)$html;
    if (
        stripos($html, '<!doctype') === false &&
        stripos($html, '<html') === false &&
        stripos($html, '<body') === false
    ) {
        return $html;
    }

    return rc_translate_html($html);
}

function rc_i18n_is_public_request(): bool
{
    if (defined('IS_CLI') && IS_CLI) {
        return false;
    }

    $requestTarget = strtolower((string)($_SERVER['SCRIPT_NAME'] ?? '') . ' ' . (string)($_SERVER['REQUEST_URI'] ?? ''));
    foreach (['/admin/', '/phpmyadmin/', '/api/', '/webhook/', '/install/'] as $privatePath) {
        if (strpos($requestTarget, $privatePath) !== false) {
            return false;
        }
    }

    return true;
}

function rc_i18n_start_output_buffer(): void
{
    static $started = false;
    if ($started || !rc_i18n_is_public_request()) {
        return;
    }

    ob_start('rc_i18n_output_callback');
    $started = true;
}

function rc_lang_url($language): string
{
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = parse_url($uri, PHP_URL_PATH);
    $query = parse_url($uri, PHP_URL_QUERY);
    $params = [];
    if (is_string($query) && $query !== '') {
        parse_str($query, $params);
    }

    $params['lang'] = rc_i18n_normalize_language($language);
    $queryString = http_build_query($params);
    return ($path ?: '/') . ($queryString !== '' ? '?' . $queryString : '');
}
