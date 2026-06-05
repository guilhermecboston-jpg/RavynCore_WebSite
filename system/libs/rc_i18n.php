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
        ['pt-br' => 'Reflect Potion', 'en' => 'Reflect Potion', 'es' => 'Poción Reflect'],
        ['pt-br' => 'Reflect Damage', 'en' => 'Reflect Damage', 'es' => 'Daño Reflect'],
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
        ['pt-br' => 'masculino', 'en' => 'male', 'es' => 'masculino'],
        ['pt-br' => 'feminino', 'en' => 'female', 'es' => 'femenino'],
        ['pt-br' => '[sugerir nome]', 'en' => '[suggest name]', 'es' => '[sugerir nombre]'],
        ['pt-br' => '[sugerir número]', 'en' => '[suggest number]', 'es' => '[sugerir número]'],
        ['pt-br' => 'Use um endereço real!', 'en' => 'Please use real address!', 'es' => '¡Usa una dirección real!'],
        ['pt-br' => 'Enviaremos um link para validar seu e-mail.', 'en' => 'We will send a link to validate your Email.', 'es' => 'Enviaremos un link para validar tu e-mail.'],
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
        ['pt-br' => 'Reflect Potion', 'en' => 'Reflect Potion', 'es' => 'Poción Reflect'],
        ['pt-br' => 'Reflect Damage', 'en' => 'Reflect Damage', 'es' => 'Daño Reflect'],
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
        ['pt-br' => 'Utilize o <span class="rc-hf-highlight">HuntFinder</span>, localizado no <span class="rc-hf-highlight">+1 do Templo</span>, para consultar respawns e ser teleportado diretamente para a hunt escolhida.', 'en' => 'Use <span class="rc-hf-highlight">HuntFinder</span>, located on <span class="rc-hf-highlight">Temple +1</span>, to check respawns and teleport directly to the selected hunt.', 'es' => 'Usa <span class="rc-hf-highlight">HuntFinder</span>, ubicado en el <span class="rc-hf-highlight">+1 del Templo</span>, para consultar respawns y teletransportarte directamente a la hunt elegida.'],
        ['pt-br' => 'Cada card exibe as criaturas disponíveis naquele respawn, com opções de <span class="rc-hf-highlight">detalhes</span>, <span class="rc-hf-highlight">favoritos</span> e <span class="rc-hf-highlight">teleporte</span>.', 'en' => 'Each card shows the creatures available in that respawn, with <span class="rc-hf-highlight">details</span>, <span class="rc-hf-highlight">favorites</span>, and <span class="rc-hf-highlight">teleport</span> options.', 'es' => 'Cada card muestra las criaturas disponibles en ese respawn, con opciones de <span class="rc-hf-highlight">detalles</span>, <span class="rc-hf-highlight">favoritos</span> y <span class="rc-hf-highlight">teleport</span>.'],
        ['pt-br' => 'Use a barra de busca para filtrar hunts pelo nome da criatura ou do local.', 'en' => 'Use the search bar to filter hunts by creature or location name.', 'es' => 'Usa la barra de búsqueda para filtrar hunts por nombre de criatura o ubicación.'],
        ['pt-br' => 'Consultar quais criaturas estão disponíveis em cada respawn.', 'en' => 'Check which creatures are available in each respawn.', 'es' => 'Consultar qué criaturas están disponibles en cada respawn.'],
        ['pt-br' => 'Filtrar hunts por nível de <span class="rc-hf-highlight">dificuldade</span>.', 'en' => 'Filter hunts by <span class="rc-hf-highlight">difficulty</span> level.', 'es' => 'Filtrar hunts por nivel de <span class="rc-hf-highlight">dificultad</span>.'],
        ['pt-br' => 'Selecionar a instância desejada (<span class="rc-hf-highlight">Ravyn Depths I</span> a <span class="rc-hf-highlight">V</span>) quando a hunt possuir mais de uma localização.', 'en' => 'Select the desired instance (<span class="rc-hf-highlight">Ravyn Depths I</span> to <span class="rc-hf-highlight">V</span>) when the hunt has more than one location.', 'es' => 'Seleccionar la instancia deseada (<span class="rc-hf-highlight">Ravyn Depths I</span> a <span class="rc-hf-highlight">V</span>) cuando la hunt tenga más de una ubicación.'],
        ['pt-br' => 'Marcar hunts como <span class="rc-hf-highlight">favoritos</span> e filtrar apenas favoritos.', 'en' => 'Mark hunts as <span class="rc-hf-highlight">favorites</span> and filter only favorites.', 'es' => 'Marcar hunts como <span class="rc-hf-highlight">favoritas</span> y filtrar solo favoritas.'],
        ['pt-br' => 'Teleportar diretamente para o respawn selecionado.', 'en' => 'Teleport directly to the selected respawn.', 'es' => 'Teletransportarte directamente al respawn seleccionado.'],
        ['pt-br' => 'Hunts introdutórias, ideais para começar a explorar o sistema e conhecer os respawns.', 'en' => 'Introductory hunts, ideal for starting to explore the system and learning the respawns.', 'es' => 'Hunts introductorias, ideales para empezar a explorar el sistema y conocer los respawns.'],
        ['pt-br' => 'Dificuldade intermediária. Respawns mais exigentes, com criaturas e recompensas superiores.', 'en' => 'Intermediate difficulty. More demanding respawns with stronger creatures and better rewards.', 'es' => 'Dificultad intermedia. Respawns más exigentes, con criaturas y recompensas superiores.'],
        ['pt-br' => 'Hunts avançadas para personagens preparados. Maior risco e melhor potencial de loot.', 'en' => 'Advanced hunts for prepared characters. Higher risk and better loot potential.', 'es' => 'Hunts avanzadas para personajes preparados. Mayor riesgo y mejor potencial de loot.'],
        ['pt-br' => 'O mais alto nível de dificuldade disponível no HuntFinder, reservado aos respawns mais desafiadores.', 'en' => 'The highest difficulty level available in HuntFinder, reserved for the most challenging respawns.', 'es' => 'El nivel de dificultad más alto disponible en HuntFinder, reservado para los respawns más desafiantes.'],
        ['pt-br' => 'Todas as hunts possuem um <span class="rc-hf-highlight">teleport de retorno</span> para o <span class="rc-hf-highlight">templo de RavynCore</span>.', 'en' => 'All hunts have a <span class="rc-hf-highlight">return teleport</span> to the <span class="rc-hf-highlight">RavynCore temple</span>.', 'es' => 'Todas las hunts tienen un <span class="rc-hf-highlight">teleport de retorno</span> al <span class="rc-hf-highlight">templo de RavynCore</span>.'],
        ['pt-br' => 'O teleport de retorno <span class="rc-hf-highlight">não possui Protection Zone (PZ)</span>. Ao utilizá-lo, você <span class="rc-hf-highlight">não estará em área segura</span>.', 'en' => 'The return teleport <span class="rc-hf-highlight">does not have Protection Zone (PZ)</span>. When using it, you <span class="rc-hf-highlight">will not be in a safe area</span>.', 'es' => 'El teleport de retorno <span class="rc-hf-highlight">no tiene Protection Zone (PZ)</span>. Al usarlo, <span class="rc-hf-highlight">no estarás en una zona segura</span>.'],
        ['pt-br' => 'Se estiver com <span class="rc-hf-highlight">PZ Lock</span> (PvP / atacou outro jogador) ao usar o teleport de retorno, você <span class="rc-hf-highlight">não será enviado ao templo</span>.', 'en' => 'If you have <span class="rc-hf-highlight">PZ Lock</span> (PvP / attacked another player) when using the return teleport, you <span class="rc-hf-highlight">will not be sent to the temple</span>.', 'es' => 'Si tienes <span class="rc-hf-highlight">PZ Lock</span> (PvP / atacaste a otro jugador) al usar el teleport de retorno, <span class="rc-hf-highlight">no serás enviado al templo</span>.'],
        ['pt-br' => 'Nessa situação, será transportado <span class="rc-hf-highlight">aleatoriamente</span> para um dos barcos ao redor de RavynCore:', 'en' => 'In that situation, you will be transported <span class="rc-hf-highlight">randomly</span> to one of the boats around RavynCore:', 'es' => 'En esa situación, serás transportado <span class="rc-hf-highlight">aleatoriamente</span> a uno de los barcos alrededor de RavynCore:'],
        ['pt-br' => 'Primeira instância paralela. Disponível em diversas hunts como opção de teleporte.', 'en' => 'First parallel instance. Available in several hunts as a teleport option.', 'es' => 'Primera instancia paralela. Disponible en varias hunts como opción de teleport.'],
        ['pt-br' => 'Segunda instância paralela. Alguns respawns possuem esta localização como alternativa.', 'en' => 'Second parallel instance. Some respawns have this location as an alternative.', 'es' => 'Segunda instancia paralela. Algunos respawns tienen esta ubicación como alternativa.'],
        ['pt-br' => 'Terceira instância paralela. Permite distribuir hunts entre instâncias quando o respawn oferece múltiplos pontos.', 'en' => 'Third parallel instance. Lets hunts be distributed between instances when the respawn offers multiple points.', 'es' => 'Tercera instancia paralela. Permite distribuir hunts entre instancias cuando el respawn ofrece múltiples puntos.'],
        ['pt-br' => 'Quarta instância paralela. Selecionável no painel de detalhes quando disponível para a hunt.', 'en' => 'Fourth parallel instance. Selectable in the details panel when available for the hunt.', 'es' => 'Cuarta instancia paralela. Seleccionable en el panel de detalles cuando está disponible para la hunt.'],
        ['pt-br' => 'Quinta instância paralela. Use quando precisar de uma instância adicional do mesmo respawn.', 'en' => 'Fifth parallel instance. Use it when you need an additional instance of the same respawn.', 'es' => 'Quinta instancia paralela. Úsala cuando necesites una instancia adicional del mismo respawn.'],
        ['pt-br' => 'Barco localizado ao <span class="rc-hf-highlight">norte</span> de RavynCore.', 'en' => 'Boat located to the <span class="rc-hf-highlight">north</span> of RavynCore.', 'es' => 'Barco ubicado al <span class="rc-hf-highlight">norte</span> de RavynCore.'],
        ['pt-br' => 'Barco localizado à <span class="rc-hf-highlight">esquerda (oeste)</span> de RavynCore.', 'en' => 'Boat located to the <span class="rc-hf-highlight">left (west)</span> of RavynCore.', 'es' => 'Barco ubicado a la <span class="rc-hf-highlight">izquierda (oeste)</span> de RavynCore.'],
        ['pt-br' => 'Barco localizado à <span class="rc-hf-highlight">direita (leste)</span> de RavynCore.', 'en' => 'Boat located to the <span class="rc-hf-highlight">right (east)</span> of RavynCore.', 'es' => 'Barco ubicado a la <span class="rc-hf-highlight">derecha (este)</span> de RavynCore.'],
        ['pt-br' => 'O destino é escolhado <span class="rc-hf-highlight">aleatoriamente</span> a cada utilização do teleport enquanto você estiver com <span class="rc-hf-highlight">PZ Lock</span>. Battle de monstro não impede o retorno ao templo.', 'en' => 'The destination is chosen <span class="rc-hf-highlight">randomly</span> each time the teleport is used while you have <span class="rc-hf-highlight">PZ Lock</span>. Monster battle does not prevent returning to the temple.', 'es' => 'El destino se elige <span class="rc-hf-highlight">aleatoriamente</span> cada vez que usas el teleport mientras tienes <span class="rc-hf-highlight">PZ Lock</span>. Battle de monstruo no impide el retorno al templo.'],
        ['pt-br' => 'cooldown de 2 dias', 'en' => '2-day cooldown', 'es' => 'cooldown de 2 días'],
        ['pt-br' => 'Isso permite:', 'en' => 'This allows you to:', 'es' => 'Esto te permite:'],
        ['pt-br' => 'No <strong>RavynCore</strong>, você pode remover e reaplicar o <em>Tier</em> dos seus equipamentos sempre que desejar.', 'en' => 'In <strong>RavynCore</strong>, you can remove and reapply the <em>Tier</em> from your equipment whenever you want.', 'es' => 'En <strong>RavynCore</strong>, puedes remover y reaplicar el <em>Tier</em> de tus equipamentos cuando quieras.'],
        ['pt-br' => 'Remover o <span class="rc-tier-highlight">Tier</span> antes de uma nova tentativa de upgrade;', 'en' => 'Remove the <span class="rc-tier-highlight">Tier</span> before a new upgrade attempt;', 'es' => 'Remover el <span class="rc-tier-highlight">Tier</span> antes de un nuevo intento de upgrade;'],
        ['pt-br' => 'Vender o item sem o <span class="rc-tier-highlight">Tier</span> aplicado;', 'en' => 'Sell the item without the <span class="rc-tier-highlight">Tier</span> applied;', 'es' => 'Vender el item sin el <span class="rc-tier-highlight">Tier</span> aplicado;'],
        ['pt-br' => 'Alterar sua build ou estilo de jogo;', 'en' => 'Change your build or playstyle;', 'es' => 'Cambiar tu build o estilo de juego;'],
        ['pt-br' => 'Reaproveitar seus <span class="rc-tier-highlight">Tiers</span> em outros equipamentos.', 'en' => 'Reuse your <span class="rc-tier-highlight">Tiers</span> on other equipment.', 'es' => 'Reutilizar tus <span class="rc-tier-highlight">Tiers</span> en otros equipamentos.'],
        ['pt-br' => 'O sistema foi desenvolvido para oferecer mais flexibilidade e liberdade na evolução dos seus itens.', 'en' => 'The system was designed to offer more flexibility and freedom in your item progression.', 'es' => 'El sistema fue desarrollado para ofrecer más flexibilidad y libertad en la evolución de tus items.'],
        ['pt-br' => 'Ao utilizar um <strong>Extractor Tier</strong>:', 'en' => 'When using an <strong>Extractor Tier</strong>:', 'es' => 'Al usar un <strong>Extractor Tier</strong>:'],
        ['pt-br' => 'O <span class="rc-tier-highlight">Tier</span> é removido do equipamento;', 'en' => 'The <span class="rc-tier-highlight">Tier</span> is removed from the equipment;', 'es' => 'El <span class="rc-tier-highlight">Tier</span> se remueve del equipamento;'],
        ['pt-br' => 'O item original é enviado para a <strong>Store Inbox</strong> sem Tier;', 'en' => 'The original item is sent to the <strong>Store Inbox</strong> without Tier;', 'es' => 'El item original se envía a la <strong>Store Inbox</strong> sin Tier;'],
        ['pt-br' => 'O <span class="rc-tier-highlight">Tier</span> removido é entregue na sua <strong>Store Inbox</strong> como um item.', 'en' => 'The removed <span class="rc-tier-highlight">Tier</span> is delivered to your <strong>Store Inbox</strong> as an item.', 'es' => 'El <span class="rc-tier-highlight">Tier</span> removido se entrega en tu <strong>Store Inbox</strong> como item.'],
        ['pt-br' => 'Ao utilizar um <span class="rc-tier-highlight">Tier</span> em um equipamento:', 'en' => 'When using a <span class="rc-tier-highlight">Tier</span> on equipment:', 'es' => 'Al usar un <span class="rc-tier-highlight">Tier</span> en un equipamento:'],
        ['pt-br' => 'O <span class="rc-tier-highlight">Tier</span> é aplicado normalmente;', 'en' => 'The <span class="rc-tier-highlight">Tier</span> is applied normally;', 'es' => 'El <span class="rc-tier-highlight">Tier</span> se aplica normalmente;'],
        ['pt-br' => 'O equipamento é enviado diretamente para a <strong>Store Inbox</strong> já com o Tier aplicado.', 'en' => 'The equipment is sent directly to the <strong>Store Inbox</strong> with the Tier already applied.', 'es' => 'El equipamento se envía directamente a la <strong>Store Inbox</strong> con el Tier aplicado.'],
        ['pt-br' => 'O <span class="rc-tier-highlight">Tier</span> nunca é perdido durante a extração;', 'en' => 'The <span class="rc-tier-highlight">Tier</span> is never lost during extraction;', 'es' => 'El <span class="rc-tier-highlight">Tier</span> nunca se pierde durante la extracción;'],
        ['pt-br' => 'É possível extrair e reaplicar <span class="rc-tier-highlight">Tiers</span> quantas vezes desejar;', 'en' => 'You can extract and reapply <span class="rc-tier-highlight">Tiers</span> as many times as you want;', 'es' => 'Puedes extraer y reaplicar <span class="rc-tier-highlight">Tiers</span> cuantas veces quieras;'],
        ['pt-br' => 'Cada extração consome <strong>1 Extractor Tier</strong>;', 'en' => 'Each extraction consumes <strong>1 Extractor Tier</strong>;', 'es' => 'Cada extracción consume <strong>1 Extractor Tier</strong>;'],
        ['pt-br' => 'O <strong>Extractor Tier</strong> está disponível na <strong>Game Store</strong> por <strong>2.000 Tibia Coins</strong>.', 'en' => 'The <strong>Extractor Tier</strong> is available in the <strong>Game Store</strong> for <strong>2,000 Tibia Coins</strong>.', 'es' => 'El <strong>Extractor Tier</strong> está disponible en la <strong>Game Store</strong> por <strong>2.000 Tibia Coins</strong>.'],
        ['pt-br' => 'Pedra básica para upgrades até o nível 4', 'en' => 'Basic stone for upgrades up to level 4', 'es' => 'Piedra básica para upgrades hasta nivel 4'],
        ['pt-br' => 'Pedra intermediária para upgrades até o nível 7', 'en' => 'Intermediate stone for upgrades up to level 7', 'es' => 'Piedra intermedia para upgrades hasta nivel 7'],
        ['pt-br' => 'Pedra épica para upgrades até o nível 12', 'en' => 'Epic stone for upgrades up to level 12', 'es' => 'Piedra épica para upgrades hasta nivel 12'],
        ['pt-br' => 'Grátis', 'en' => 'Free', 'es' => 'Gratis'],
        ['pt-br' => 'Sobre o Upgrade System', 'en' => 'About the Upgrade System', 'es' => 'Sobre el Upgrade System'],
        ['pt-br' => 'O Upgrade System tem como objetivo aprimorar suas armas, aumentando o poder de ataque por meio do uso das <strong>Upgrade Stones</strong>.', 'en' => 'The Upgrade System improves your weapons, increasing attack power through the use of <strong>Upgrade Stones</strong>.', 'es' => 'El Upgrade System mejora tus armas, aumentando el poder de ataque mediante el uso de <strong>Upgrade Stones</strong>.'],
        ['pt-br' => 'Durante o processo de refinamento, é possível utilizar diferentes pedras de aprimoramento, cada uma com uma taxa de sucesso variável. Quanto maior o nível de refinamento, menor será a chance de sucesso.', 'en' => 'During refinement, you can use different upgrade stones, each with a variable success rate. The higher the refinement level, the lower the success chance.', 'es' => 'Durante el refinamiento, puedes usar diferentes piedras de mejora, cada una con una tasa de éxito variable. Cuanto mayor el nivel de refinamiento, menor será la chance de éxito.'],
        ['pt-br' => 'Se o refinamento <strong>falhar</strong> e a arma já estiver em <strong>+1 ou superior</strong>, existe chance de <strong>perder 1 nível de upgrade</strong> — consulte <a class="rc-upg-link" href="#rc-upg-downgrade">Downgrade em Caso de Falha</a>.', 'en' => 'If refinement <strong>fails</strong> and the weapon is already <strong>+1 or higher</strong>, there is a chance to <strong>lose 1 upgrade level</strong> — see <a class="rc-upg-link" href="#rc-upg-downgrade">Downgrade on Failure</a>.', 'es' => 'Si el refinamiento <strong>falla</strong> y el arma ya está en <strong>+1 o superior</strong>, existe chance de <strong>perder 1 nivel de upgrade</strong> — consulta <a class="rc-upg-link" href="#rc-upg-downgrade">Downgrade en caso de falla</a>.'],
        ['pt-br' => 'Exemplo de look com Weapon Upgrade', 'en' => 'Example look with Weapon Upgrade', 'es' => 'Ejemplo de look con Weapon Upgrade'],
        ['pt-br' => 'Existem três tipos de Upgrade Stones disponíveis no jogo:', 'en' => 'There are three types of Upgrade Stones available in the game:', 'es' => 'Hay tres tipos de Upgrade Stones disponibles en el juego:'],
        ['pt-br' => '<strong>Basic Upgrade Stones:</strong> permite melhorias em equipamentos até o nível 4.', 'en' => '<strong>Basic Upgrade Stones:</strong> allows improvements on equipment up to level 4.', 'es' => '<strong>Basic Upgrade Stones:</strong> permite mejoras en equipamentos hasta nivel 4.'],
        ['pt-br' => '<strong>Medium Upgrade Stones:</strong> permite melhorias em equipamentos até o nível 7.', 'en' => '<strong>Medium Upgrade Stones:</strong> allows improvements on equipment up to level 7.', 'es' => '<strong>Medium Upgrade Stones:</strong> permite mejoras en equipamentos hasta nivel 7.'],
        ['pt-br' => '<strong>Epic Upgrade Stones:</strong> permite melhorias em equipamentos até o nível máximo, que é 12.', 'en' => '<strong>Epic Upgrade Stones:</strong> allows improvements on equipment up to the maximum level, which is 12.', 'es' => '<strong>Epic Upgrade Stones:</strong> permite mejoras en equipamentos hasta el nivel máximo, que es 12.'],
        ['pt-br' => '<strong>⚠️ Atenção!</strong> Ao utilizar a Fusion/Convergence Fusion no Forge System em um item com upgrade, todos os upgrades serão perdidos, pois o sistema cria um novo item, o que impossibilita manter quaisquer bônus.', 'en' => '<strong>⚠️ Attention!</strong> When using Fusion/Convergence Fusion in the Forge System on an upgraded item, all upgrades will be lost because the system creates a new item, making it impossible to keep any bonuses.', 'es' => '<strong>⚠️ Atención!</strong> Al usar Fusion/Convergence Fusion en el Forge System en un item con upgrade, todos los upgrades se perderán porque el sistema crea un nuevo item, lo que impide mantener cualquier bono.'],
        ['pt-br' => 'Transfer Upgrade to Catcher', 'en' => 'Transfer Upgrade to Catcher', 'es' => 'Transferir upgrade al catcher'],
        ['pt-br' => 'Onde Obter?', 'en' => 'Where to obtain?', 'es' => '¿Dónde obtener?'],
        ['pt-br' => 'Comprando com o NPC <strong>Jorge Trambiqueiro</strong>, localizado no +1 do Templo.', 'en' => 'Buying from NPC <strong>Jorge Trambiqueiro</strong>, located on Temple +1.', 'es' => 'Comprando con el NPC <strong>Jorge Trambiqueiro</strong>, ubicado en el +1 del Templo.'],
        ['pt-br' => 'Através do sistema de <strong>Cassino</strong>.', 'en' => 'Through the <strong>Casino</strong> system.', 'es' => 'A través del sistema de <strong>Casino</strong>.'],
        ['pt-br' => 'Completando a <strong>Upgrade Stones Quest</strong>.', 'en' => 'Completing the <strong>Upgrade Stones Quest</strong>.', 'es' => 'Completando la <strong>Upgrade Stones Quest</strong>.'],
        ['pt-br' => 'Derrotando <strong>bosses custom</strong> e de <strong>invasão</strong>.', 'en' => 'Defeating <strong>custom bosses</strong> and <strong>invasion</strong> bosses.', 'es' => 'Derrotando <strong>bosses custom</strong> y de <strong>invasión</strong>.'],
        ['pt-br' => 'Tipos de Pedras', 'en' => 'Stone Types', 'es' => 'Tipos de piedras'],
        ['pt-br' => 'Taxas de Sucesso por Nível', 'en' => 'Success Rates by Level', 'es' => 'Tasas de éxito por nivel'],
        ['pt-br' => 'Downgrade em Caso de Falha', 'en' => 'Downgrade on Failure', 'es' => 'Downgrade en caso de falla'],
        ['pt-br' => 'Ao falhar uma tentativa de upgrade, armas que já estejam no nível <strong>+1 ou superior</strong> possuem uma chance de perder <strong>1 nível de upgrade</strong> (ex.: de +5 para +4).', 'en' => 'When an upgrade attempt fails, weapons already at <strong>+1 or higher</strong> have a chance to lose <strong>1 upgrade level</strong> (for example: +5 to +4).', 'es' => 'Al fallar un intento de upgrade, armas que ya estén en <strong>+1 o superior</strong> tienen una chance de perder <strong>1 nivel de upgrade</strong> (ej.: de +5 a +4).'],
        ['pt-br' => '<strong>Importante:</strong> Tentativas de upgrade de <strong>+0 para +1</strong> nunca resultam em perda de nível.', 'en' => '<strong>Important:</strong> Upgrade attempts from <strong>+0 to +1</strong> never result in level loss.', 'es' => '<strong>Importante:</strong> Intentos de upgrade de <strong>+0 a +1</strong> nunca resultan en pérdida de nivel.'],
        ['pt-br' => 'Tentando alcançar', 'en' => 'Trying to reach', 'es' => 'Intentando alcanzar'],
        ['pt-br' => 'Chance de downgrade', 'en' => 'Downgrade chance', 'es' => 'Chance de downgrade'],
        ['pt-br' => 'Bônus de Ataque', 'en' => 'Attack Bonus', 'es' => 'Bono de ataque'],
        ['pt-br' => 'Bônus', 'en' => 'Bonus', 'es' => 'Bono'],
        ['pt-br' => 'Ataque', 'en' => 'Attack', 'es' => 'Ataque'],
        ['pt-br' => 'Custo (aplicação)', 'en' => 'Cost (application)', 'es' => 'Costo (aplicación)'],
        ['pt-br' => 'Custo (extrair)', 'en' => 'Cost (extraction)', 'es' => 'Costo (extraer)'],
        ['pt-br' => '<strong>Grupo A</strong>: <span class="rc-sg-highlight">Amulet</span>, <span class="rc-sg-highlight">Ring</span>, <span class="rc-sg-highlight">Weapon</span> e <span class="rc-sg-highlight">Helmet</span>.', 'en' => '<strong>Group A</strong>: <span class="rc-sg-highlight">Amulet</span>, <span class="rc-sg-highlight">Ring</span>, <span class="rc-sg-highlight">Weapon</span>, and <span class="rc-sg-highlight">Helmet</span>.', 'es' => '<strong>Grupo A</strong>: <span class="rc-sg-highlight">Amulet</span>, <span class="rc-sg-highlight">Ring</span>, <span class="rc-sg-highlight">Weapon</span> y <span class="rc-sg-highlight">Helmet</span>.'],
        ['pt-br' => '<strong>Grupo B</strong>: <span class="rc-sg-highlight">Armor</span>, <span class="rc-sg-highlight">Legs</span>, <span class="rc-sg-highlight">Boots</span> e <span class="rc-sg-highlight">Shield / Spellbook / Quiver</span>.', 'en' => '<strong>Group B</strong>: <span class="rc-sg-highlight">Armor</span>, <span class="rc-sg-highlight">Legs</span>, <span class="rc-sg-highlight">Boots</span>, and <span class="rc-sg-highlight">Shield / Spellbook / Quiver</span>.', 'es' => '<strong>Grupo B</strong>: <span class="rc-sg-highlight">Armor</span>, <span class="rc-sg-highlight">Legs</span>, <span class="rc-sg-highlight">Boots</span> y <span class="rc-sg-highlight">Shield / Spellbook / Quiver</span>.'],
        ['pt-br' => 'Aplique uma Skill Gem em um equipamento que ainda não possua uma gema, conforme demonstrado na imagem abaixo e seguindo a <a class="rc-sg-price-link" href="#rc-sg-prices">tabela de custos</a>.', 'en' => 'Apply a Skill Gem to equipment that does not already have a gem, as shown in the image below and following the <a class="rc-sg-price-link" href="#rc-sg-prices">cost table</a>.', 'es' => 'Aplica una Skill Gem en un equipamento que aún no tenga una gema, como se muestra en la imagen abajo y siguiendo la <a class="rc-sg-price-link" href="#rc-sg-prices">tabla de costos</a>.'],
        ['pt-br' => 'Para extrair uma Skill Gem, é necessário utilizar um Remove Upgrade Status, além da quantidade de dinheiro e RavynCore Tokens indicada na <a class="rc-sg-price-link" href="#rc-sg-prices">tabela de custos</a>.', 'en' => 'To extract a Skill Gem, you must use a Remove Upgrade Status, plus the amount of money and RavynCore Tokens shown in the <a class="rc-sg-price-link" href="#rc-sg-prices">cost table</a>.', 'es' => 'Para extraer una Skill Gem, es necesario usar un Remove Upgrade Status, además de la cantidad de dinero y RavynCore Tokens indicada en la <a class="rc-sg-price-link" href="#rc-sg-prices">tabla de costos</a>.'],
        ['pt-br' => 'Após aplicar ou extrair uma Skill Gem, tanto o equipamento quanto a gema serão enviados automaticamente para a <strong>Store Inbox</strong>.', 'en' => 'After applying or extracting a Skill Gem, both the equipment and the gem are automatically sent to the <strong>Store Inbox</strong>.', 'es' => 'Después de aplicar o extraer una Skill Gem, tanto el equipamento como la gema se enviarán automáticamente a la <strong>Store Inbox</strong>.'],
        ['pt-br' => 'Bônus por vocação (ao equipar)', 'en' => 'Bonus by vocation (when equipped)', 'es' => 'Bonos por vocación (al equipar)'],
        ['pt-br' => 'Skills com bônus', 'en' => 'Skills with bonus', 'es' => 'Skills con bono'],
        ['pt-br' => 'Observação', 'en' => 'Note', 'es' => 'Observación'],
        ['pt-br' => 'Gemas de Skill', 'en' => 'Skill Gems', 'es' => 'Gemas de Skill'],
        ['pt-br' => 'Grupo', 'en' => 'Group', 'es' => 'Grupo'],
        ['pt-br' => 'Tabela de custos', 'en' => 'Cost table', 'es' => 'Tabla de costos'],
        ['pt-br' => 'Bônus nas três skills melee ao equipar.', 'en' => 'Bonus to all three melee skills when equipped.', 'es' => 'Bono en las tres skills melee al equipar.'],
        ['pt-br' => 'Bônus nas duas skills ao equipar (magic e fist).', 'en' => 'Bonus to both skills when equipped (magic and fist).', 'es' => 'Bono en las dos skills al equipar (magic y fist).'],
        ['pt-br' => 'Sword, Club e Axe', 'en' => 'Sword, Club and Axe', 'es' => 'Sword, Club y Axe'],
        ['pt-br' => 'Distance e Shield', 'en' => 'Distance and Shield', 'es' => 'Distance y Shield'],
        ['pt-br' => 'Magic Level e Fist', 'en' => 'Magic Level and Fist', 'es' => 'Magic Level y Fist'],
        ['pt-br' => 'Amulet, Ring, Weapon ou Helmet', 'en' => 'Amulet, Ring, Weapon or Helmet', 'es' => 'Amulet, Ring, Weapon o Helmet'],
        ['pt-br' => 'Armor, Legs, Boots ou Shield/Book/Quiver', 'en' => 'Armor, Legs, Boots or Shield/Book/Quiver', 'es' => 'Armor, Legs, Boots o Shield/Book/Quiver'],
        ['pt-br' => 'Utilize o Boss Finder, localizado no <strong>+1 do Templo</strong>, para selecionar um boss e ser teleportado diretamente para o waypoint da alavanca.', 'en' => 'Use Boss Finder, located on <strong>Temple +1</strong>, to select a boss and teleport directly to the lever waypoint.', 'es' => 'Usa Boss Finder, ubicado en el <strong>+1 del Templo</strong>, para seleccionar un boss y teletransportarte directamente al waypoint de la palanca.'],
        ['pt-br' => 'O cooldown é iniciado no momento em que a alavanca é acionada, e <strong>não</strong> após a morte do boss.', 'en' => 'The cooldown starts when the lever is pulled, <strong>not</strong> after the boss dies.', 'es' => 'El cooldown comienza cuando se acciona la palanca, y <strong>no</strong> después de la muerte del boss.'],
        ['pt-br' => 'O tempo padrão de cooldown é de <strong>20 horas</strong>.', 'en' => 'The default cooldown time is <strong>20 hours</strong>.', 'es' => 'El cooldown estándar es de <strong>20 horas</strong>.'],
        ['pt-br' => 'Alguns bosses exigem a derrota de todos os Mini Bosses da sua progressão para liberar o acesso ao Boss Final.', 'en' => 'Some bosses require defeating all Mini Bosses in their progression to unlock access to the Final Boss.', 'es' => 'Algunos bosses requieren derrotar todos los Mini Bosses de su progresión para liberar el acceso al Boss final.'],
        ['pt-br' => 'Ao derrotar o Boss Final, a progressão é reiniciada. Para enfrentá-lo novamente, será necessário derrotar todos os Mini Bosses outra vez.', 'en' => 'When the Final Boss is defeated, the progression resets. To face it again, you must defeat all Mini Bosses once more.', 'es' => 'Al derrotar al Boss final, la progresión se reinicia. Para enfrentarlo de nuevo, será necesario derrotar todos los Mini Bosses otra vez.'],
        ['pt-br' => 'É obrigatório derrotar todos os Mini Bosses para liberar o acesso ao Boss Final.', 'en' => 'You must defeat all Mini Bosses to unlock access to the Final Boss.', 'es' => 'Es obligatorio derrotar todos los Mini Bosses para liberar el acceso al Boss final.'],
        ['pt-br' => 'O progresso é individual para cada linha de bosses.', 'en' => 'Progress is individual for each boss line.', 'es' => 'El progreso es individual para cada línea de bosses.'],
        ['pt-br' => 'Ao derrotar o Boss Final, todos os Mini Bosses da respectiva progressão são resetados.', 'en' => 'When the Final Boss is defeated, all Mini Bosses from that progression are reset.', 'es' => 'Al derrotar al Boss final, todos los Mini Bosses de la progresión respectiva se reinician.'],
        ['pt-br' => 'Para enfrentar o Boss Final novamente, será necessário refazer toda a progressão.', 'en' => 'To face the Final Boss again, you must redo the entire progression.', 'es' => 'Para enfrentar al Boss final nuevamente, será necesario rehacer toda la progresión.'],
        ['pt-br' => 'Bosses com cooldown especial: <strong>Ascending Ferumbras</strong> (2 dias) e <strong>Bakragore</strong> (2 dias). Os demais seguem o cooldown padrão do servidor.', 'en' => 'Bosses with special cooldown: <strong>Ascending Ferumbras</strong> (2 days) and <strong>Bakragore</strong> (2 days). The others follow the server default cooldown.', 'es' => 'Bosses con cooldown especial: <strong>Ascending Ferumbras</strong> (2 días) y <strong>Bakragore</strong> (2 días). Los demás siguen el cooldown estándar del servidor.'],
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
    $params = [];
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $query = parse_url($uri, PHP_URL_QUERY);

    if (is_array($_GET) && !empty($_GET)) {
        $params = $_GET;
    } elseif (is_string($query) && $query !== '') {
        parse_str($query, $params);
    }

    unset($params['lang']);

    $hasPageParam = isset($params['subtopic']) || isset($params['p']);
    if (!$hasPageParam && defined('PAGE') && PAGE !== '' && PAGE !== '404') {
        foreach (array_keys($params) as $key) {
            if (!is_string($key)) {
                continue;
            }

            // Remove legacy route markers like ?highscores or ?account/create.
            if (($params[$key] === '' || $params[$key] === null) && !in_array($key, [
                'action', 'name', 'list', 'category', 'vocation', 'world', 'world_type', 'order', 'page', 'guild', 'id', 'image', 'template'
            ], true)) {
                unset($params[$key]);
            }
        }

        $params = array_merge(['subtopic' => PAGE], $params);
    }

    foreach (['action', 'name', 'list', 'category', 'vocation', 'world', 'world_type', 'order', 'page', 'guild', 'id', 'image'] as $routeParam) {
        if (!isset($params[$routeParam]) && isset($_REQUEST[$routeParam])) {
            $params[$routeParam] = $_REQUEST[$routeParam];
        }
    }

    $params['lang'] = rc_i18n_normalize_language($language);
    $queryString = http_build_query($params);
    $baseUrl = defined('BASE_URL') ? BASE_URL : '/';

    return $baseUrl . ($queryString !== '' ? '?' . $queryString : '');
}
