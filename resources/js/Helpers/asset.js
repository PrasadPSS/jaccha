export const asset = (path) => {
    const baseUrl = import.meta.env.VITE_APP_URL;
    return `${baseUrl}${path}`;
};