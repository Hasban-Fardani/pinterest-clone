import { fetchApi } from './api';

// Get all posts
export async function getAllPosts(token: string) {
  return fetchApi('/api/v1/posts', 'GET', undefined, token);
}

// Get post by ID
export async function getPostById(postId: number, token: string) {
  return fetchApi(`/api/v1/posts/${postId}`, 'GET', undefined, token);
}

// Like a post
export async function likePost(postId: number, token: string) {
  return fetchApi(`/api/v1/posts/${postId}/like`, 'POST', undefined, token);
}

// Add a comment to a post
export async function addComment(postId: number, comment: string, token: string) {
  return fetchApi(
    `/api/v1/posts/${postId}/comment`,
    'POST',
    { comment },
    token
  );
}
