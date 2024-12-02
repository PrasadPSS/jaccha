import { asset } from '@/Helpers/asset';

export default function ApplicationLogo(props) {
    return (
        <img width={50} height="50" src={asset('backend-assets/images/logo/logo.png')} alt="" />
    );
}
