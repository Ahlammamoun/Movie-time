# dico de données

Movie
| Syntax      | Description |
| ----------- | ----------- |
| Type      |        |
| tire   |         |
| durée      |        |
| résumé   |         |
| synopsis      |        |
| rating   |         |
| date      |        |
| poster   |         |

Saison
| Syntax      | Description |
| ----------- | ----------- |
|nom|  |
|nb_episode|  |

Acteur
| Syntax      | Description |
| ----------- | ----------- |
|nom|  |
|prenom|  |

Genre
| Syntax      | Description |
| ----------- | ----------- |
|nom|  |

User
| Syntax      | Description |
| ----------- | ----------- |
|nom|  |
|prenom|  |
|mot de passe|  |
|role|  |
|status|  |

Review
| Syntax      | Description |
| ----------- | ----------- |
| titre |  |
| text|  |
|date|  |
|note|  |

OneToMany => One Movie To Many Season
ManyToOne => Many Season To One Movie
