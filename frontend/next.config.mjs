import MillionLint from "@million/lint";
/** @type {import('next').NextConfig} */
const nextConfig = {
    images: {
        remotePatterns: [
            {
                protocol: 'https',
                hostname: 'i.pinimg.com'
            },
            {
                protocol: 'https',
                hostname: 'via.placeholder.com'
            }
        ]
    }
};

// export default nextConfig
export default MillionLint.next({
  enabled: true,
  rsc: true,
})(nextConfig);
