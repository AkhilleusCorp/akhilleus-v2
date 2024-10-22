import React from 'react';
import MemberHeader from "app/member/layouts/MemberHeader.tsx";
import MemberFooter from "app/member/layouts/MemberFooter.tsx";

interface MemberLayoutType {
    children: React.ReactNode
}

const MemberLayout: React.FC<MemberLayoutType> = (props) => {
    return (
        <>
            <MemberHeader />

            <main id={"logged-page-body"}>
                {props.children}
            </main>

            <MemberFooter />
        </>
    );
}

export default MemberLayout;