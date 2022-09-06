<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produto')->insert([
            [
                'nome' => 'Smartphone Samsung Galaxy M52 5G Preto 128GB, 6GB RAM, Tela Infinita de 6.7, Câmera Tripla, Bateria de 5000mAh e Processador Snapdragon 778G',
                'descricao' => 'O Galaxy M52 5G possui um poderoso processador Octa Core de última geração, oferecendo muito desempenho e potência, ideal para jogos pesados ou tarefas simultâneas. O design elegante e superfino traz uma incrível tela infinita Super AMOLED+ de 6,7 polegadas, garantindo imagens nítidas em alta resolução e sem qualquer lentidão graças a sua taxa de atualização de 120Hz.
                Seu armazenamento interno conta com 128 GB, além de suporte para um cartão microSD de até 1 TB(vendido separadamente), é muito espaço para guardar suas fotos, vídeos, músicas ou qualquer arquivo de registro daqueles momentos inesquecíveis. Seu conjunto de câmeras, são três sensores na parte de traz do aparelho, são capazes de capturar fotos sensacionais. A câmera principal com 64GB é perfeita para cliques durante todo o dia. A câmera Ultra Wide expande o ângulo de visão em até 123º e garante fotos com mais perspectiva, e a câmera Macro aproxima você dos detalhes.',
                'preco' => '1799',
                'imagem1' => 'sm1.webp',
                'imagem2' => 'sm2.webp',
                'imagem3' => 'sm3.webp',
                'imagem4' => 'sm4.webp',
                'imagem5' => 'sm5.webp',
                'estoque' => '10',
                'preco_promocional' => '1699',
                'categoria_id' => 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'iPhone 11 Apple 128GB Branco Tela de 6,1, Câmera Dupla de 12MP, iOS',
                'descricao' => 'Grave vídeos 4K, faça belos retratos e capture paisagens inteiras com o novo sistema de câmera dupla. Tire fotos incríveis com pouca luz usando o modo Noite. Veja cores fiéis em fotos, vídeos e jogos na tela Liquid Retina de 6.1 polegadas***. Leve o desempenho sem precedentes do chip A13 Bionic para seus games, realidade aumentada e fotografia. Faça muito e recarregue pouco com a bateria para o dia todo**. E conte com resistência à água de até dois metros por até 30 minutos*.',
                'preco' => '3299',
                'imagem1' => 'iphone.webp',
                'imagem2' => 'iphone2.webp',
                'imagem3' => 'iphone3.webp',
                'imagem4' => 'iphone4.webp',
                'imagem5' => '',
                'estoque' => '10',
                'preco_promocional' => '3199',
                'categoria_id' => 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Smartphone Samsung Galaxy S10 Plus Preto 128GB',
                'descricao' => '
                Estimado tendo como base o perfil de uso de um usuário médio/comum. Avaliado de forma independente pela Strategy Analytics entre 8 e 20 de dezembro de 2021 nos EUA e no Reino Unido com as versões de pré-lançamento SM-S901, SM-S906 e SM-S908 sob condições padronizadas usando redes 5G Sub6 (NÃO testado para rede 5G mmWave). A duração real da bateria varia conforme o ambiente de rede, recursos e aplicativos usados, frequência de chamadas e mensagens, número de cargas e muitos outros fatores.
                A disponibilidade da cor pode variar conforme o país ou a operadora.
                Quando comparado à série S21.
                O Quick Share está disponível em smartphones Galaxy e tablets Galaxy no sistema operacional Android OS versão 10.0(Q) e One UI 2.1 ou superior, Galaxy Book Ion, Ion 2, Flex, Flex Alpha, Flex 2, Flex 2 Alpha e Galaxy Book S lançados em ou após maio de 2021 e Samsung Notebook Odyssey, Plus e Plus2 lançados em ou após 2020.',
                'preco' => '7299',
                'imagem1' => '1xg.jpg',
                'imagem2' => '2xg.jpg',
                'imagem3' => '3xg.jpg',
                'imagem4' => '4xg.jpg',
                'imagem5' => '',
                'estoque' => '9',
                'preco_promocional' => '7199',
                'categoria_id' => 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Smartphone Motorola Moto G22 Azul 128GB 4GB RAM Tela de 6.5” Câmera Traseira Quádrupla Android 12 Processador Octa Core 2.3 GHz',
                'descricao' => 'O Motorola Moto G22 possui sistema Quad Câmera avançado, tela Max Vision de alta resolução e bateria de longa duração. Tudo o que você sempre quis e muito mais. Tire fotos mais claras e nítidas em qualquer iluminação e ângulo, com um sistema de câmera de 50 MP. Faça selfies incríveis tanto de dia quanto de noite com a câmera frontal de 16 MP. Não se preocupe com espaço para armazenar suas fotos. O Moto G22 tem 128GB de espaço interno e possibilidade de expandir até 1TB com um cartão Micro SD. Realize suas tarefas com agilidade e rode os seus aplicativos favoritos tranquilamente com processador Octa Core.',
                'preco' => '1299',
                'imagem1' => '1g.jpg',
                'imagem2' => '2g.jpg',
                'imagem3' => '3g.jpg',
                'imagem4' => '',
                'imagem5' => '',
                'estoque' => '07',
                'preco_promocional' => '1199',
                'categoria_id' => 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'iPhone 13 Apple 256GB Meia-noite Tela de 6,1”, Câmera Dupla de 12MP',
                'descricao' => 'Grave vídeos 4K, faça belos retratos e capture paisagens inteiras com o novo sistema de câmera dupla. Tire fotos incríveis com pouca luz usando o modo Noite. Veja cores fiéis em fotos, vídeos e jogos na tela Liquid Retina de 6.1 polegadas***. Leve o desempenho sem precedentes do chip A13 Bionic para seus games, realidade aumentada e fotografia. Faça muito e recarregue pouco com a bateria para o dia todo**. E conte com resistência à água de até dois metros por até 30 minutos*.',
                'preco' => '6499',
                'imagem1' => '1g.webp',
                'imagem2' => '2g.webp',
                'imagem3' => '3x.webp',
                'imagem4' => '4g.webp',
                'imagem5' => '5g.webp',
                'estoque' => '05',
                'preco_promocional' => '5999',
                'categoria_id' => 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'iPhone 13 Pro Apple 256GB Dourado Tela de 6,1 e Câmera Tripla',
                'descricao' => 'iPhone 13 Pro. O maior upgrade do sistema de câmera Pro até hoje. Tela Super Retina XDR com ProMotion para uma experiência mais rápida e responsiva. Chip A15 Bionic com velocidade impressionante. 5G ultrarrápido*. Design resistente. E um salto imenso na duração da bateria.',
                'preco' => '7999',
                'imagem1' => '1x13.webp',
                'imagem2' => '2x13.webp',
                'imagem3' => '3x13.webp',
                'imagem4' => '4x13.webp',
                'imagem5' => '',
                'estoque' => '03',
                'preco_promocional' => '7299',
                'categoria_id' => 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Notebooks
            [
                'nome' => 'Notebook Gamer Acer NVIDIA GeForce GTX 1650 Core i5-10300H 8GB 512GB SSD Tela Full HD 15.6” Windows 11 Nitro 5 AN515-55- 59T40',
                'descricao' => 'O notebook gamer Acer Nitro 5 eleva a sua experiência em jogos ao mais alto nível. Com uma configuração potente e que não treme na hora do desafio, o Acer Nitro 5 permite que você mergulhe de cabeça na ação.
                Encare os mais intensos desafios com força máxima e surpreenda os inimigos. Com o processador da 10ª geração Core i5 e memória de 8GB RAM você tem o poder de fogo necessário para superar qualquer inimigo.
                A placa de vídeo NVIDIA GeForce GTX 1650 torna a sua experiência mais imersiva, com gráficos nítidos e precisos. Você ainda poderá gravar e compartilhar os melhores momentos do seu gameplay através do NVIDIA Shadowplay.
                O Acer Nitro 5 vem equipado com 512GB SSD. É muito espaço para armazenar todos os seus arquivos e velocidade de leitura e gravação superior a um HD tradicional. Com o SSD, todos os seus jogos abrirão em poucos segundos.',
                'preco' => '3999',
                'imagem1' => '1n.jpg',
                'imagem2' => '2n.jpg',
                'imagem3' => '3n.jpg',
                'imagem4' => '4n.jpg',
                'imagem5' => '',
                'estoque' => '10',
                'preco_promocional' => '2999',
                'categoria_id' => 2,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Notebook Gamer 2 A.M. NVIDIA GeForce GTX 1050 Core i7-9700 16GB 1TB 128GB SSD Tela Full HD 15.6” Windows 10 E550',
                'descricao' => 'O notebook gamer 2 A.M. é o notebook de ponta que você precisa para jogar. Com a configuração de processador de 10ª geração Core i7 e memória de 16GB RAM, você tem o poder de fogo necessário para superar qualquer inimigo.',
                'preco' => '7999',
                'imagem1' => '1n2.webp',
                'imagem2' => '2n2.webp',
                'imagem3' => '3n2.webp',
                'imagem4' => '4n2.webp',
                'imagem5' => '',
                'estoque' => '05',
                'preco_promocional' => '7399',
                'categoria_id' => 2,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Notebook Gamer Samsung NVIDIA GeForce GTX 1650 Core i5-9300H 8GB 1TB Tela Full HD 15.6” Windows 10 Odyssey NP850XBD-XG1BR',
                'descricao' => 'O notebook gamer Samsung é o notebook de ponta que você precisa para jogar. Com a configuração de processador de 10ª geração Core i5 e memória de 8GB RAM, você tem o poder de fogo necessário para superar qualquer inimigo.',
                'preco' => '6599',
                'imagem1' => '1n3.webp',
                'imagem2' => '2n3.webp',
                'imagem3' => '3n3.webp',
                'imagem4' => '4n3.webp',
                'imagem5' => '',
                'estoque' => '05',
                'preco_promocional' => '5999',
                'categoria_id' => 2,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nome' => 'Notebook Gamer Lenovo NVIDIA GeForce GTX 1650 Core i5-10300H 8GB 256GB SSD Tela Full HD 15.6” Linux Ideapad Gaming 3i 82CGS00100',
                'descricao' => 'O notebook gamer Lenovo é o notebook de ponta que você precisa para jogar. Com a configuração de processador de 10ª geração Core i5 e memória de 8GB RAM, você tem o poder de fogo necessário para superar qualquer inimigo.',
                'preco' => '5699',
                'imagem1' => '1n4.webp',
                'imagem2' => '2n4.webp',
                'imagem3' => '3n4.webp',
                'imagem4' => '4n4.webp',
                'imagem5' => '5n4.webp',
                'estoque' => '05',
                'preco_promocional' => '5199',
                'categoria_id' => 2,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //Tablets
            [
                'nome' => 'Tablet Samsung Galaxy S7 FE T735 4G, 128GB, 6GB RAM, Tela imersiva 12.4", Caneta S Pen, Câmera Traseira 8MP, Câmera frontal de 5MP, Android 11 - Preto',
                'descricao' => 'Desenvolvido para reunir a conectividade de um smartphone e o desempenho de um computador, o tablet Galaxy Tab S7 FE possibilita que os usuários desfrutem de recursos de alto nível para diversos tipos de tarefa. Um tablet perfeito para realizar atividades profissionais ou de lazer de forma simples e prática.
                Além de estar pronto para aproveitar o melhor das principais plataformas de streaming para séries, filmes, músicas e podcasts, o Galaxy Tab S7 FE conta ainda com conteúdos especiais para crianças e ferramentas de controle parental no Samsung Kids. Um grande diferencial do Galaxy Tab S7 FE é seu sistema de alto-falantes duplos com sonorização AKG, e a presença da tecnologia Dolby Atmos aprimora ainda mais o som, fornecendo uma experiência de áudio poderosa e imersiva.',
                'preco' => '3999',
                'imagem1' => '1t.jpg',
                'imagem2' => '2t.jpg',
                'imagem3' => '3t.jpg',
                'imagem4' => '4t.jpg',
                'imagem5' => '',
                'estoque' => '10',
                'preco_promocional' => '3699',
                'categoria_id' => 3,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Tablet Lenovo Tab P11 Plus 64GB, 4GB RAM, Tela de 11”, Câmera Traseira 13MP, Câmera Frontal de 8MP, 4G, WI-FI e Android 11 - Grafite',
                'descricao' => 'O tablet Lenovo Tab P11 Plus é um tablet de ponta que você precisa para jogar. Com a configuração de processador de 10ª geração Core i5 e memória de 8GB RAM, você tem o poder de fogo necessário para superar qualquer inimigo.',
                'preco' => '1999',
                'imagem1' => '1t3.webp',
                'imagem2' => '2t3.webp',
                'imagem3' => '3t3.webp',
                'imagem4' => '4t3.webp',
                'imagem5' => '',
                'estoque' => '10',
                'preco_promocional' => '1799',
                'categoria_id' => 3,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Computadores
            [
                'nome' => 'PC Gamer Computador Intel Core i5 10GB HD 500GB Nvidia Geforce GT EasyPC Light 2',
                'descricao' => 'Essa linha foi criada para você que quer começar a jogar agora, mas tem uma limitação no orçamento para investir no seu Pc Gamer.
                Todos os integrantes dessa linha estão preparados para receber upgrades futuros, seja na placa de vídeo, memória, HDs, SSDs, etc.
                Criamos uma maneira de você embarcar agora no universo gaming e quando quiser trocar algum componente para melhorar ainda mais o desempenho.
                Jogue títulos famosos com a sua Nvidia Geforce Gt 210 através das saídas Hdmi, Dvi ou Vga',
                'preco' => '1999',
                'imagem1' => '1c.webp',
                'imagem2' => '2c.webp',
                'imagem3' => '3c.webp',
                'imagem4' => '4c.jpg',
                'imagem5' => '',
                'estoque' => '10',
                'preco_promocional' => '1799',
                'categoria_id' => 4,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Pc Gamer Neologic NLI82737 AMD Ryzen 5 5600G 16GB (Radeon Vega 7 Integrado) SSD 240GB',
                'descricao' => '"#PressStart
                O PC Gamer Neologic foi feito para quem quer entrar de cabeça no mundo dos games mas não quer abrir mão do melhor desempenho! Trazendo um incrível custo-benefício e os melhores componentes do mercado, ele vai proporcionar partidas incríveis.
                O Melhor de Tudo
                Desenvolvido com os melhores componentes do mercado, oferecemos produtos de alta qualidade.
                Garantia de 1 Ano
                Todos os computadores Neologic possuem garantia de 12 meses e todo o suporte necessário

                ESTE PC JÁ VEM MONTADO E PRONTO PARA JOGAR.

                Características do Produto:
                Placa de Vídeo:
                - Radeon Vega 7 Integrado
                Processador:
                - AMD Ryzen 5 5600G, 3.9GHz (4.4GHz Max Turbo) 6 Núcleos
                Placa Mãe:
                - A520
                Memória Gamer:
                - 16GB DDR4
                SSD:
                - 240Gb
                Gabinete:
                - Exclusive Neologic (Imagens internas meramente ilustrativas, Coolers fans não incluso)
                Gravador de DVD/CD: Não Incluso
                Fonte:
                - 400w 80 Plus
                Voltagem: Bivolt 110v - 220v
                Tipo de PC:
                - Gamer
                Saida HDMI: Sim
                Sistema Operacional:
                - Windows 10, versão para avaliação, pelo período de 30 dias

                Conteúdo da Embalagem: 1 Computador Neologic PC Gamer
                Imagem Do Fabricante: Meramente ilustrativa. A marca das peças pode variar de acordo com o estoque momentâneo em nossa fábrica, garantimos manter sempre o nível de ótima qualidade dos produtos e atender o mínimo estipulado no computador. Nunca um modelo inferior.
                "',
                'preco' => '2599',
                'imagem1' => '1c2.webp',
                'imagem2' => '2c2.webp',
                'imagem3' => '3c2.webp',
                'imagem4' => '4c2.webp',
                'imagem5' => '',
                'estoque' => '10',
                'preco_promocional' => '2399',
                'categoria_id' => 4,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}
