export async function fetchApi(
  endpoint: string,
  method: string = "GET",
  body?: Record<string, any>,
  token?: string
) {
  const headers: HeadersInit = {
    "Content-Type": "application/json",
  };
  if (token) headers["Authorization"] = `Bearer ${token}`;

  const response = await fetch(endpoint, {
    method,
    headers,
    body: body ? JSON.stringify(body) : undefined,
  });

  if (!response.ok) {
    const error = await response.json();
    throw new Error(error.message || "API request failed");
  }
  return response.json();
}
