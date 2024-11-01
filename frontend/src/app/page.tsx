import React from 'react';
import Image from 'next/image';

const posts = [
  // Sample data for the image posts
  { id: 1, src: 'https://via.placeholder.com/300', title: 'Custom DnD Portrait' },
  { id: 2, src: 'https://via.placeholder.com/300', title: 'Runic Circle' },
  { id: 3, src: 'https://via.placeholder.com/300', title: 'Agricultural Work' },
  { id: 4, src: 'https://via.placeholder.com/300', title: 'Fantasy Map' },
  // ... add more sample posts
];

const HomePage = () => {
  return (
      <div className="px-6 pt-6 grid-container">
        {posts.map((post) => (
          <div key={post.id} className="post-item">
            <Image
              src={post.src}
              alt={post.title}
              width={300}
              height={300}
              layout="responsive"
              className="rounded-lg"
            />
            <p className="mt-2 text-sm font-semibold">{post.title}</p>
          </div>
        ))}
      </div>
  );
};

export default HomePage;
