"use client";

import { useState, useEffect } from "react";
import axios from 'axios';
import { useRouter } from "next/navigation";

const http = axios.create({
    baseURL: 'http://localhost:8000',
    withCredentials: true,
    withXSRFToken: true,
});

const Pens = () => {
    const [pens, setPens] = useState([]);
    const router = useRouter();
    const [info, setInfo] = useState({});

    // @ts-ignore
    const getPens = async (url) => {
        if (!url) {
            url = 'http://localhost:8000/api/pens';
        }
        const response = await fetch(url);
        const json = await response.json();
        setPens(json.data.data);
        setInfo(json.data);
    }

    useEffect(() => {
        // @ts-ignore
        getPens();
    }, []);

    const deletePen = async (id: number) => {
        if (confirm('削除しますか？')) {
            http.delete(`/api/pens/${id}`).then(() => {
                // @ts-ignore
                getPens();
            });
        }
    }

    const handleNextPage = () => {
        // @ts-ignore
        getPens(info.next_page_url);
    }

    const handlePreviousPage = () => {
        // @ts-ignore
        getPens(info.prev_page_url);
    }

    // @ts-ignore
    return (
        <div className="relative overflow-x-auto p-5">
            <table className="min-w-full divide-y dark:divide-neutral-700">
                <thead>
                <tr>
                    <th scope="col" className="px-6 py-4">ID</th>
                    <th scope="col" className="px-6 py-4">名前</th>
                    <th scope="col" className="px-6 py-4">価格</th>
                    <th scope="col" className="px-3 py-4"></th>
                    <th scope="col" className="px-3 py-4"></th>
                    <th scope="col" className="px-3 py-4">
                        <button
                            className="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            onClick={()=> {
                                router.push('/pens/create');
                            }}
                        >新規登録</button>
                    </th>
                </tr>
                </thead>
                <tbody>
                    {
                        pens.map((pen: any) => {
                            return (
                                <tr key={pen.id} className="bg-white border-b">
                                    <th scope="row" className="px-6 py-2">{pen.id}</th>
                                    <td className="px-6 py-2">{pen.name}</td>
                                    <td className="px-6 py-2">{pen.price}円</td>
                                    <td className="px-3 py-2 text-right">
                                        <button
                                            className="px-2 py-1 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none"
                                            onClick={() => {
                                                router.push(`/pens/edit/${pen.id}`)
                                            }}
                                        >編集</button>
                                    </td>
                                    <td className="px-3 py-2">
                                        <button
                                            className="px-2 py-1 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 disabled:opacity-50 disabled:pointer-events-none"
                                            onClick={()=>{
                                                deletePen(pen.id);
                                            }}
                                        >削除</button>
                                    </td>
                                </tr>
                            )
                        })
                    }
                </tbody>
            </table>
            <div className="w-1/2 items-center px-4 mt-6">
                <div className="join grid grid-cols-2">
                    {info.prev_page_url ? (
                        <button className="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                                onClick={handlePreviousPage}
                        >
                            <svg className="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m15 18-6-6 6-6"></path>
                            </svg>
                            <span>PreviousPage</span>
                        </button>
                    ) : null}
                    {info.next_page_url ? (
                        <button className="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                                onClick={handleNextPage}>
                            <span>NextPage</span>
                            <svg className="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </button>
                    ) : null}
                </div>
            </div>
        </div>
    );
}

export default Pens;