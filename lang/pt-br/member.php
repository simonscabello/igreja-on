<?php

return [
    'labels' => [
        'member' => 'Membro',
        'members' => 'Membros',
    ],
    'attributes' => [
        'name' => 'Nome',
        'email' => 'E-mail',
        'phone' => 'Telefone',
    ],
    'actions' => [
        'create_member' => 'Criar Membro',
        'edit_member' => 'Editar Membro',
        'show_member' => 'Mostrar Membro',
        'delete_member' => 'Deletar Membro',
    ],
    'messages' => [
        'member_created' => 'Membro :name criado com sucesso!',
        'member_updated' => 'Membro :name atualizado com sucesso!',
        'member_deleted' => 'Membro deletado com sucesso!',
        'member_not_found' => 'Membro não encontrado!',
        'member_not_created' => 'Membro não foi criado! :message',
        'member_not_updated' => 'Membro não foi atualizado! :message',
        'member_not_deleted' => 'Membro não foi deletado! :message',
    ],
    'validation' => [
        'name_required' => 'O campo nome é obrigatório!',
        'name_max' => 'O campo nome deve ter no máximo 255 caracteres!',
        'email_email' => 'O campo e-mail deve ser um e-mail válido!',
        'email_unique' => 'O campo e-mail já está em uso!',
        'email_max' => 'O campo e-mail deve ter no máximo 255 caracteres!',
        'phone_max' => 'O campo telefone deve ter no máximo 255 caracteres!',
    ]
];
