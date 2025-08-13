<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    public function run(): void
    {
        \DB::table('articles')->insert([
            [
                'content' => 'Imagine a future where artificial intelligence quietly shoulders the drudgery of software development...',
                'image' => 'https://news.mit.edu/sites/default/files/styles/news_article__image_gallery/public/images/202507/MIT%20News-AI%20coding%20.png?itok=Y2s_xKEX',
                'title' => 'AI Codes: The Future of Software Development',
                'slug' => 'ai-codes-the-future-of-software-development',
                'writer_id' => 9,
                'category_id' => 2,
                'status' => 'review',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => null
            ],
            [
                'content' => 'The neural network artificial intelligence models used in applications like medical image processing...',
                'image' => 'https://news.mit.edu/sites/default/files/styles/news_article__image_gallery/public/images/202501/MIT-Symmetric-Tensors-01_0.jpg?itok=igbN9NPf',
                'title' => 'User-friendly system can help developers build more efficient simulations and AI models',
                'slug' => 'user-friendly-system-can-help-developers-build-more-efficient-simulations-and-ai-models',
                'writer_id' => 9,
                'category_id' => 1,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => '2025-05-01'
            ],
            [
                'content' => 'Ask a large language model (LLM) like GPT-4 to smell a rain-soaked campsite...',
                'image' => 'https://news.mit.edu/sites/default/files/styles/news_article__image_gallery/public/images/202407/MIT-EmRep.png?itok=TxKivfW-',
                'title' => 'LLMs develop their own understanding of reality as their language abilities improve',
                'slug' => 'llms-develop-their-own-understanding-of-reality-as-their-language-abilities-improve',
                'writer_id' => 9,
                'category_id' => 1,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => '2024-06-20'
            ],
            [

                'content' => 'One of the most popular fruits, apples are chock-full of nutrition...',
                'image' => 'https://images.unsplash.com/photo-1694955729369-eaf757ed22a3?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'Apple Fruits: What They Are and How to Eat Them',
                'slug' => 'apple-fruits-what-they-are-and-how-to-eat-them',
                'writer_id' => 10,
                'category_id' => 3,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => '2021-05-10'
            ],
            [

                'content' => 'Climate change is no longer a distant threat—it’s here...',
                'image' => 'https://images.unsplash.com/photo-1615092296061-e2ccfeb2f3d6?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'Climate Change: Challenges and Solutions for Our Planet',
                'slug' => 'climate-change-challenges-and-solutions-for-our-planet',
                'writer_id' => 11,
                'category_id' => 4,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => '2023-09-15'
            ],
            [

                'content' => 'Exploring the latest breakthroughs in quantum computing and its impact on cybersecurity...',
                'image' => 'https://plus.unsplash.com/premium_photo-1661877737564-3dfd7282efcb?q=80&w=900&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'Quantum Computing: The Next Tech Revolution',
                'slug' => 'quantum-computing-the-next-tech-revolution',
                'writer_id' => 9,
                'category_id' => 1,
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => null
            ],
            [

                'content' => 'Tips and tricks for mastering Laravel for scalable and secure backend applications...',
                'image' => 'https://images.unsplash.com/photo-1618388810903-840bb0d15ea5?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'Mastering Laravel for Web Development',
                'slug' => 'mastering-laravel-for-web-development',
                'writer_id' => 9,
                'category_id' => 6,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => '2025-02-18'
            ],
            [

                'content' => 'The health benefits of regular meditation and how it improves mental clarity...',
                'image' => 'https://images.unsplash.com/photo-1602192509154-0b900ee1f851?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'Meditation: A Path to Mental Wellness',
                'slug' => 'meditation-a-path-to-mental-wellness',
                'writer_id' => 9,
                'category_id' => 3,
                'status' => 'review',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => null
            ],
            [

                'content' => 'Exploring the beauty and culture of Japan through its historic temples...',
                'image' => 'https://images.unsplash.com/photo-1480796927426-f609979314bd?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'Travel Guide: Exploring Japan',
                'slug' => 'travel-guide-exploring-japan',
                'writer_id' => 9,
                'category_id' => 5,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => '2024-12-01'
            ],
            [

                'content' => 'Understanding the fundamentals of programming languages and their paradigms...',
                'image' => 'https://images.unsplash.com/photo-1557324232-b8917d3c3dcb?q=80&w=871&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'Programming Paradigms Explained',
                'slug' => 'programming-paradigms-explained',
                'writer_id' => 9,
                'category_id' => 2,
                'status' => 'archived',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => '2023-11-20'
            ],
            [
                'content' => 'Discover how AI is shaping the travel industry with personalized recommendations...',
                'image' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'AI in Travel: The Future of Personalized Trips',
                'slug' => 'ai-in-travel-the-future-of-personalized-trips',
                'writer_id' => 10,
                'category_id' => 5,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => '2024-07-15'
            ],
            [

                'content' => 'A beginner’s guide to meal planning and nutrition for a healthy lifestyle...',
                'image' => 'https://images.unsplash.com/photo-1466637574441-749b8f19452f?q=80&w=580&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'Meal Planning 101: Eat Smart',
                'slug' => 'meal-planning-101-eat-smart',
                'writer_id' => 10,
                'category_id' => 4,
                'status' => 'review',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => null
            ],
            [

                'content' => 'Why TypeScript is becoming the preferred choice for modern web applications...',
                'image' => 'https://developer.mozilla.org/en-US/docs/Learn_web_development/Core/Frameworks_libraries/Svelte_TypeScript/03-vscode-hints-in-main-ts.png',
                'title' => 'TypeScript: The Future of Web Development',
                'slug' => 'typescript-the-future-of-web-development',
                'writer_id' => 10,
                'category_id' => 6,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => '2025-03-10'
            ],
            [

                'content' => 'An overview of essential vitamins and how they contribute to overall health...',
                'image' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=853&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'Essential Vitamins for a Healthy Body',
                'slug' => 'essential-vitamins-for-a-healthy-body',
                'writer_id' => 10,
                'category_id' => 4,
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => null
            ],
            [

                'content' => 'Exploring the top 10 tech trends to watch in the coming decade...',
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=872&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'title' => 'Top 10 Tech Trends of the Next Decade',
                'slug' => 'top-10-tech-trends-of-the-next-decade',
                'writer_id' => 10,
                'category_id' => 1,
                'status' => 'archived',
                'created_at' => now(),
                'updated_at' => now(),
                'published_at' => '2024-08-15'
            ],
        ]);
    }
}
